@extends('layouts.app')

@section('content')
<div class="container app-container">
    <section class="profile-hero">
        <div class="row g-4 align-items-center">
            <div class="col-auto">
                <span class="avatar-ring" style="width: 160px; height: 160px;">
                    <img src="{{ $user->profile->profileImage() }}" alt="{{ $user->username }}" class="profile-avatar">
                </span>
            </div>

            <div class="col">
                <div class="profile-title-row">
                    <div>
                        <h1 class="profile-username">{{ $user->username }}</h1>
                        <p class="muted-copy mb-0">{{ $user->profile->title }}</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        @can('update', $user->profile)
                            <a href="/p/create" class="btn btn-app-primary">
                                <i class="bi bi-plus-square me-2"></i>Add post
                            </a>
                            <a href="/profile/{{ $user->id }}/edit" class="btn btn-app-secondary">
                                <i class="bi bi-pencil-square me-2"></i>Edit profile
                            </a>
                        @else
                            <follow-button :user-id="{{ $user->id }}" :follows="@json($follows)"></follow-button>
                        @endcan
                    </div>
                </div>

                <div class="profile-stats">
                    <div class="profile-stat">
                        <strong>{{ $postsCount }}</strong>
                        <span>posts</span>
                    </div>
                    <div class="profile-stat">
                        <strong>{{ $followersCount }}</strong>
                        <span>followers</span>
                    </div>
                    <div class="profile-stat">
                        <strong>{{ $followingCount }}</strong>
                        <span>following</span>
                    </div>
                </div>

                <p class="mb-2">{{ $user->profile->description }}</p>
                @if($user->profile->url)
                    <a class="fw-bold" href="{{ $user->profile->url }}" target="_blank" rel="noreferrer">
                        <i class="bi bi-link-45deg me-1"></i>{{ $user->profile->url }}
                    </a>
                @endif
            </div>
        </div>

        <div class="profile-tabs" aria-label="Profile sections">
            <span class="profile-tab active"><i class="bi bi-grid-3x3"></i>Posts</span>
            <span class="profile-tab"><i class="bi bi-bookmark"></i>Saved</span>
            <span class="profile-tab"><i class="bi bi-person-square"></i>Tagged</span>
        </div>
    </section>

    @forelse($user->posts as $post)
        @if($loop->first)
            <section class="profile-grid" aria-label="{{ $user->username }} posts">
        @endif

        <a class="profile-grid-item" href="/p/{{ $post->id }}">
            <img src="/storage/{{ $post->image }}" alt="{{ $post->caption }}">
            <span class="profile-grid-overlay">
                <span><i class="bi bi-heart-fill me-1"></i>0</span>
                <span><i class="bi bi-chat-fill me-1"></i>0</span>
            </span>
        </a>

        @if($loop->last)
            </section>
        @endif
    @empty
        <div class="empty-state mt-4">
            <i class="bi bi-grid-3x3"></i>
            <h2>No posts yet</h2>
            <p class="muted-copy">When {{ $user->username }} shares photos, they will show up here.</p>
            @can('update', $user->profile)
                <a href="/p/create" class="btn btn-app-primary mt-2">
                    <i class="bi bi-plus-square me-2"></i>Create first post
                </a>
            @endcan
        </div>
    @endforelse
</div>
@endsection
