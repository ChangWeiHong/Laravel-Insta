@extends('layouts.app')

@section('content')
<div class="container app-container">
    <article class="post-detail">
        <img src="/storage/{{ $post->image }}" alt="{{ $post->caption }}" class="post-detail-media">

        <div class="post-detail-panel">
            <header class="post-header border-bottom">
                <a class="post-author" href="/profile/{{ $post->user->id }}">
                    <img src="{{ $post->user->profile->profileImage() }}" alt="{{ $post->user->username }}">
                    <span>
                        <span class="post-author-name d-block">{{ $post->user->username }}</span>
                        <span class="post-meta">{{ $post->created_at->diffForHumans() }}</span>
                    </span>
                </a>

                @if(auth()->id() !== $post->user_id)
                    <follow-button :user-id="{{ $post->user->id }}" :follows="@json($follows)"></follow-button>
                @endif
            </header>

            <section class="p-4 flex-grow-1">
                <p class="mb-4">
                    <a class="post-author-name" href="/profile/{{ $post->user->id }}">{{ $post->user->username }}</a>
                    {{ $post->caption }}
                </p>

                <div class="empty-state py-4">
                    <i class="bi bi-chat-dots"></i>
                    <h3>Start the conversation</h3>
                    <p class="muted-copy mb-0">Comments are ready for the next product iteration.</p>
                </div>
            </section>

            <footer class="post-footer border-top">
                <div class="post-actions">
                    <button class="icon-button" type="button" aria-label="Like">
                        <i class="bi bi-heart"></i>
                    </button>
                    <button class="icon-button" type="button" aria-label="Comment">
                        <i class="bi bi-chat"></i>
                    </button>
                    <button class="icon-button" type="button" aria-label="Share">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
                <button class="icon-button" type="button" aria-label="Save">
                    <i class="bi bi-bookmark"></i>
                </button>
            </footer>
        </div>
    </article>
</div>
@endsection
