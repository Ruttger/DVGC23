@extends('layouts.app')

@section('marker')
	<div class="topnav">
        <a href="/home">Home</a>
        <a class="active"href="/forum">Forum</a>
        <a href="/calendar">Calendar</a>
		<a href="/login">Login</a>       
	</div>
@endsection  

@section('headline')
	<h1> Forum </h1>
@endsection  

@section('content')
	<h3> Skapa en ny tråd </h3>

	<form action="/forum/{forumID}/thread/create" method="post">
		@csrf
		<table>	
			
			<tr>
				<td>
					<input type="text" name="title" placeholder="Title">
				</td>				
			</tr>
			<tr>
				<td>
					<textarea name="body" rows="10" cols="30">
						Meddelande
					</textarea>					
				</td>				
			</tr>
			<tr>
				<td>
					<input type="hidden" id="forumID" name="forumID" value="{{ $forumID }}">
					<input type="submit" value="Skapa">
				</td>				
			</tr>
	</table>
	</form>
	{{ $forumID }}
@endsection  
