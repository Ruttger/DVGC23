@extends('layouts.app')

@section('marker')
	<div class="topnav">
        <a class="active" href="/">Home</a>
        <a href="/forum">Forum</a>
        <a href="/calendar">Calendar</a>
        @guest
			<a href="{{ route('login') }}">{{ __('Login') }}</a> 
		@endguest
		@auth
			<a href="{{ route('logout') }}"
	            onclick="event.preventDefault();
	            document.getElementById('logout-form').submit();">
	            {{ Auth::user()->role }} {{ __('logout') }}
	        </a>

	        <!-- Anropas av när man trycker på logout, routen i Auth::route kräver post -->
	        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	        	@csrf
	        </form>
        @endauth      
	</div>
@endsection  

@section('headline')
	<h1> Home </h1>
@endsection  

@section('content')
	<p> This is home </p>
@endsection  

