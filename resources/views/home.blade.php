@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-4">
            <img src="https://surround-bg.com/wp-content/uploads/2018/10/laravel-logo.png" class="rounded-circle" style="max-height: 220px;">
        </div>

        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user-> username }}</h1>
                <a href="#">Add New Post</a>
            </div>
            <div class="d-flex">
                <div class="pr-3"><strong>Author</strong></div>
                <div class="pr-3"><strong>is</strong></div>
                <div class="pr-3"><strong>Chang Wei Hong</strong></div>

            </div>

            <div class="pt-4 font-weight-bold">{{ $user->profile-> title }}</div>
            <div>{{ $user->profile-> description }}</div>
            <div><a href="#">{{ $user->profile-> url }}</a></div>
        </div>
    </div>

    <div class="row pt-4">
        <div class="col-4" class="w-100"> <img src="http://probation.gov.ph/wp-content/uploads/2018/09/Awards-300x223.png"></div>
        <div class="col-4" class="w-100"> <img src="http://probation.gov.ph/wp-content/uploads/2018/09/Awards-300x223.png"></div>
        <div class="col-4" class="w-100"> <img src="http://probation.gov.ph/wp-content/uploads/2018/09/Awards-300x223.png"></div>
    </div>
</div>
@endsection
