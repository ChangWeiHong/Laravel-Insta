@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
	<div class="col-8">
     <img src="/storage/{{$post->image}}" alt="" class="w-50">   
    </div>

	    <div class="">
	    	<div class="d-flex align-items-center">
	    	<div><img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle p-2" style="max-height: 50px;">
	    	</div>
	    	<div class="font-weight-bold">
	       <a href="/profile/{{$post->user->id}}">
	       	<span class="text-dark">{{ $post->user->username }}</span></a>   |
	       	<a href="#" class="pl-3">Follow</a>
	        </div>
	        </div>
			<hr>
	        <div class="d-flex">
	        
	        <p>
	        	<span class="font-weight-bold">
	       			<a href="/profile/{{$post->user->id}}">
	       			<span class="text-dark">{{ $post->user->username }}</span></a>
	        	</span>
	        {{ $post->caption }}</p>
	        </div>
	    </div>
    </div>
</div>
@endsection
