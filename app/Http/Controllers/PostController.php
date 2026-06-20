<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $followingUserIds = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $followingUserIds)->with('user.profile')->latest()->paginate(5);
        $followingProfiles = auth()->user()->following()->with('user')->latest()->take(8)->get();
        $suggestedUsers = User::with('profile')
            ->where('id', '!=', auth()->id())
            ->whereNotIn('id', $followingUserIds)
            ->latest()
            ->take(5)
            ->get();

        return view('posts.index', compact('posts', 'followingProfiles', 'suggestedUsers'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $this->transformUploadedImage($imagePath, 1200, 1200);

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/'.auth()->user()->id);

    }

    public function show(Post $post)
    {
        $post->load('user.profile');
        $follows = auth()->user()->following->contains($post->user->profile->id);

        return view('posts.show', compact('post', 'follows'));
    }
}
