@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <section class="form-panel">
            <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="form-title mb-1">Edit profile</h1>
                    <p class="form-subtitle mb-0">Tune your profile details and creator image.</p>
                </div>
                <a href="/profile/{{ $user->id }}" class="btn btn-app-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to profile
                </a>
            </div>

            <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4" required autocomplete="description">{{ old('description') ?? $user->profile->description }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="url" class="form-label fw-bold">URL</label>
                            <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url">

                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="upload-zone text-center">
                            <img src="{{ $user->profile->profileImage() }}" alt="{{ $user->username }}" class="avatar mb-3" style="width: 112px; height: 112px;">
                            <label for="image" class="form-label fw-bold d-block">Profile image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <p class="muted-copy mb-0 mt-2">A square crop keeps your profile sharp everywhere.</p>

                            @error('image')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-app-primary mt-4">
                    <i class="bi bi-check2-circle me-2"></i>Save profile
                </button>
            </form>
        </section>
    </div>
</div>
@endsection
