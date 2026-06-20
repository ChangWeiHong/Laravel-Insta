@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <section class="form-panel">
            <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="form-title mb-1">Create post</h1>
                    <p class="form-subtitle mb-0">Upload a square-ready photo and write a caption for the feed.</p>
                </div>
                <a href="/profile/{{ auth()->id() }}" class="btn btn-app-secondary">
                    <i class="bi bi-person-circle me-2"></i>Profile
                </a>
            </div>

            <form action="/p" enctype="multipart/form-data" method="post">
                @csrf

                <div class="mb-4">
                    <label for="caption" class="form-label fw-bold">Post caption</label>
                    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption" autofocus>

                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="upload-zone mb-4">
                    <label for="image" class="form-label fw-bold d-flex align-items-center gap-2">
                        <i class="bi bi-cloud-arrow-up"></i>Post image
                    </label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                    <p class="muted-copy mb-0 mt-2">Images are cropped to a polished square feed format.</p>

                    @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-app-primary">
                    <i class="bi bi-plus-square me-2"></i>Add post
                </button>
            </form>
        </section>
    </div>
</div>
@endsection
