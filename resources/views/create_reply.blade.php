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
	<h3> Skriv ditt svar </h3>

	<form action="/forum/{forumID}/thread/{threadID}/create" method="post">
		@csrf
		<table>	
			<tr>
				<td>
					<textarea name="body" rows="10" cols="30">
						Meddelande
					</textarea>					
				</td>				
			</tr>
			<tr>
				<td>
					<input type="hidden" id="threadID" name="threadID" value="{{ $threadID }}">
					<input type="submit" value="Skicka svar">
				</td>				
			</tr>
	</table>
	</form>
	Forum ID: {{ $forumID }} <br>
	Thread ID: {{ $threadID }}
@endsection  

