@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
	<div class="col-6 offset-3">
     <a href="/profile/{{$post->user_id}}"><img src="/storage/{{$post->image}}" alt="" class="w-100"></a>   
    </div>
    </div>

    <div class="row pt-2 pb-5">
	    <div class="col-6 offset-3">
	        <div class="d-flex">
            <div><img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle p-2" style="max-height: 50px;">
	    	</div>
	        <p>
	        	<span class="font-weight-bold">
	       			<a href="/profile/{{$post->user->id}}">
	       			<span class="text-dark">{{ $post->user->username }}</span></a>
	        	</span>
	        {{ $post->caption }}</p>
	        </div>
	    </div>
    </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts-> links() }}
        </div>
    </div>
</div>
@endsection
