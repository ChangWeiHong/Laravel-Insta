@extends('layouts.app')

@section('content')
<div class="container app-container">
    <div class="feed-layout">
        <section class="feed-column" aria-label="Photo feed">
            <div class="story-strip">
                <a class="story-item" href="/profile/{{ auth()->id() }}">
                    <span class="avatar-ring">
                        <img src="{{ auth()->user()->profile->profileImage() }}" alt="{{ auth()->user()->username }}">
                    </span>
                    <span>You</span>
                </a>

                @foreach($followingProfiles as $profile)
                    <a class="story-item" href="/profile/{{ $profile->user_id }}">
                        <span class="avatar-ring">
                            <img src="{{ $profile->profileImage() }}" alt="{{ $profile->user->username }}">
                        </span>
                        <span>{{ Str::limit($profile->user->username, 9) }}</span>
                    </a>
                @endforeach
            </div>

            @forelse($posts as $post)
                <article class="feed-post">
                    <header class="post-header">
                        <a class="post-author" href="/profile/{{ $post->user->id }}">
                            <img src="{{ $post->user->profile->profileImage() }}" alt="{{ $post->user->username }}">
                            <span>
                                <span class="post-author-name d-block">{{ $post->user->username }}</span>
                                <span class="post-meta">{{ $post->created_at->diffForHumans() }}</span>
                            </span>
                        </a>

                        <button class="icon-button" type="button" aria-label="Post options">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </header>

                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" alt="{{ $post->caption }}" class="post-media">
                    </a>

                    <div class="post-footer">
                        <div class="post-actions" aria-label="Post actions">
                            <button class="icon-button" type="button" aria-label="Like">
                                <i class="bi bi-heart"></i>
                            </button>
                            <a class="icon-button" href="/p/{{ $post->id }}" aria-label="Comment">
                                <i class="bi bi-chat"></i>
                            </a>
                            <button class="icon-button" type="button" aria-label="Share">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                        <button class="icon-button" type="button" aria-label="Save">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>

                    <div class="post-caption">
                        <p class="mb-1">
                            <a class="post-author-name" href="/profile/{{ $post->user->id }}">{{ $post->user->username }}</a>
                            {{ $post->caption }}
                        </p>
                        <a class="post-meta" href="/p/{{ $post->id }}">View conversation</a>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <i class="bi bi-camera"></i>
                    <h2>Your feed is waiting</h2>
                    <p class="muted-copy mx-auto" style="max-width: 440px;">
                        Follow creators to shape this feed, or publish your first photo to start the story.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        <a class="btn btn-app-primary" href="/p/create">
                            <i class="bi bi-plus-square me-2"></i>Create post
                        </a>
                        <a class="btn btn-app-secondary" href="/profile/{{ auth()->id() }}">
                            <i class="bi bi-person-circle me-2"></i>View profile
                        </a>
                    </div>
                </div>
            @endforelse

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </section>

        <aside class="feed-sidebar">
            <div class="app-panel mb-3">
                <div class="profile-summary">
                    <img src="{{ auth()->user()->profile->profileImage() }}" alt="{{ auth()->user()->username }}">
                    <div class="flex-grow-1">
                        <a class="post-author-name d-block" href="/profile/{{ auth()->id() }}">{{ auth()->user()->username }}</a>
                        <span class="muted-copy">{{ auth()->user()->profile->title }}</span>
                    </div>
                    <a class="post-meta fw-bold" href="/profile/{{ auth()->id() }}">View</a>
                </div>
            </div>

            <div class="app-panel mb-3">
                <div class="panel-title">
                    <span>Suggested for you</span>
                    <span>{{ $suggestedUsers->count() }}</span>
                </div>

                @forelse($suggestedUsers as $suggestedUser)
                    <div class="suggestion-row">
                        <a class="d-flex align-items-center gap-2" href="/profile/{{ $suggestedUser->id }}">
                            <img src="{{ $suggestedUser->profile->profileImage() }}" alt="{{ $suggestedUser->username }}">
                            <span>
                                <span class="suggestion-name d-block">{{ $suggestedUser->username }}</span>
                                <span class="suggestion-meta">New creator</span>
                            </span>
                        </a>
                        <a class="post-meta fw-bold" href="/profile/{{ $suggestedUser->id }}">Open</a>
                    </div>
                @empty
                    <div class="d-grid gap-2">
                        <div class="skeleton-line"></div>
                        <div class="skeleton-line w-75"></div>
                        <p class="muted-copy mb-0">No new suggestions right now.</p>
                    </div>
                @endforelse
            </div>

            <div class="app-panel">
                <div class="panel-title mb-2">
                    <span>Activity</span>
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <p class="muted-copy mb-0">
                    Your latest follows and photo uploads will appear here as the community grows.
                </p>
            </div>
        </aside>
    </div>
</div>
@endsection
