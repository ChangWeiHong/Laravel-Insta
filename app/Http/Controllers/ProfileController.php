<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postsCount = Cache::remember(
            'count.posts.'
            .$user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.'
            .$user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.'
            .$user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });

        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function search()
    {
        $query = trim((string) request('q'));
        $users = collect();

        if ($query !== '') {
            $users = User::with('profile')
                ->where('id', '!=', auth()->id())
                ->where(function ($builder) use ($query) {
                    $builder->where('username', 'like', "%{$query}%")
                        ->orWhere('name', 'like', "%{$query}%");
                })
                ->limit(12)
                ->get();
        }

        return view('profiles.search', compact('query', 'users'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => ['nullable', 'url'],
            'image' => ['nullable', 'image'],
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $this->transformUploadedImage($imagePath, 1000, 1000);
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
