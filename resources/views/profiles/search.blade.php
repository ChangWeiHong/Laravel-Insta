@extends('layouts.app')

@section('content')
<div class="container app-container">
    <section class="app-panel">
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
            <div>
                <h1 class="form-title mb-1">Search creators</h1>
                <p class="form-subtitle mb-0">Find profiles by name or username.</p>
            </div>
            <a href="{{ url('/') }}" class="btn btn-app-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to feed
            </a>
        </div>

        <form class="app-search mb-4" style="width: min(100%, 520px);" action="{{ route('profiles.search') }}" method="GET">
            <i class="bi bi-search"></i>
            <input type="search" name="q" value="{{ $query }}" aria-label="Search" placeholder="Search creators" autofocus>
        </form>

        @if($query === '')
            <div class="empty-state">
                <i class="bi bi-search"></i>
                <h2>Search by creator</h2>
                <p class="muted-copy mb-0">Type a name or username to discover profiles.</p>
            </div>
        @else
            @forelse($users as $user)
                <div class="suggestion-row">
                    <a class="d-flex align-items-center gap-3" href="/profile/{{ $user->id }}">
                        <img src="{{ $user->profile->profileImage() }}" alt="{{ $user->username }}">
                        <span>
                            <span class="suggestion-name d-block">{{ $user->username }}</span>
                            <span class="suggestion-meta">{{ $user->name }}</span>
                        </span>
                    </a>
                    <a class="btn btn-app-secondary btn-sm" href="/profile/{{ $user->id }}">Open</a>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-person-x"></i>
                    <h2>No creators found</h2>
                    <p class="muted-copy mb-0">Try a different name or username.</p>
                </div>
            @endforelse
        @endif
    </section>
</div>
@endsection
