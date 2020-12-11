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
	<h3> Skapa nytt Forum </h3>

	<form action="/forum/{categoryID}/forum/create" method="post">
		@csrf
		<table>	
			
			<tr>
				<td>
					<input type="text" name="title" placeholder="Title">
				</td>				
			</tr>
			<tr>
				<td>
					<input type="text" name="subtitle" placeholder="Beskrivning">				
				</td>				
			</tr>
			<tr>
				<td>
					<input type="hidden" id="categoryID" name="categoryID" value="{{ $categoryID }}">
					<input type="submit" value="Skapa">
				</td>				
			</tr>
	</table>
	</form>
	{{ $categoryID }}

@endsection  

