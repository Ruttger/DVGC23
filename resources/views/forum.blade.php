@extends('layouts.app')

@section('marker')
	<div class="topnav">
        <a href="/">Home</a>
        <a class="active" href="/forum">Forum</a>
        <a href="/calendar">Calendar</a>
		<a href="/login">Login</a>
	</div>
@endsection

@section('headline')
	<h1> Forum </h1>
@endsection

</style>
@section('content')
	<p> This is something in forum </p>

		<!-- Coming from Category -->
	@if($from == 'category')
		@if(count($categories) > 0)
			@foreach($categories as $category)
				<table class="category_forum" cellspacing="3">
					<thead>
						<tr>
							<th>
								<h3> {{ $category->title }} </h3>
							</th>
							<th>Antal Trådar</th>
							<th>Antal Visningar</th>
							<th>Senaste Tråden</th>
						</tr>
					</thead>
					<tbody>
						@foreach($forums as $forum)
							@if($forum->category_id == $category->id)
								<tr>
									<td>
										<h3> <a href="/forum/{{$forum->id}}">
											{{ $forum->title }}
										</a> </h3>
										<br>
										<h5> {{ $forum->subtitle }} </h5>
									</td>

									<td>0</td>
									<td>0</td>
									<td>0</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			@endforeach
		@else
			<h3> No categories... </h3>
		@endif
	@endif

		<!-- Coming from Forum -->
	@if($from == 'forum')
		@if(count($threads) > 0)
			<table class="category_forum" cellspacing="3">
				<thead>
					<tr>
						<th>
							<h3> {{ $forum->title }} </h3>
						</th>
						<th>Antal Svar</th>
						<th>Antal Visningar</th>
						<th>Senaste Svaret</th>
					</tr>
				</thead>
				<tbody>
					@foreach($threads as $thread)
						@if($thread->forum_id == $forum->id)
							<tr>
								<td>
									<h3> <a href="/forum/{{$forum->id}}/thread/{{$thread->id}}">
										{{ $thread->title }}
									</a> </h3>
									<br>
									{{-- SKAPA NY RELATION MELLAN THREAD OCH USER FÖR ATT HÄMTA USER ???
										@if(thread->user_id == user->id)
											or smt
									<h5> skapad av {{ $user->name }} </h5>

									 --}}
								</td>

								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
						@endif
					@endforeach
					<tr>
						<td colspan="4">
							<form action="/forum/{{$forum->id}}/create" method="POST">
								@csrf
								<input type="submit" value="Submit">
							</form>
						</td>
					</tr>
				</tbody>
			</table>
		@else
			<h3> No threads... </h3>
		@endif
	@endif

		<!-- Coming from Thread -->
		@if($from == 'thread')
			<table class="threads">
				<thead></thead>
				<tbody>
					<tr>
						<td>
							<h3> {{ $thread->title }} </h3>
							{{-- av {{ $user->name}} {{thread->created_at}} --}}
							{{-- <br> --}}
							{{ $thread->body }}

						</td>
						<td>
							{{-- {{ $user->avatar }} kommer troligtvis inte användas --}}
							{{-- <br> --}}
							{{-- {{ $user->name }} --}}
							{{-- <br> --}}
							{{-- {{ $user->role }} --}}
							{{-- <br> --}}
							{{-- {{ $user->posts }} --}}
							{{-- <br> --}}
							{{-- Medlem sen: {{ $user->created_at }} --}}

							test
							<br>
							admin
							<br>
							Inlägg: 2
							<br>
							Medlem sedan: Mon Nov 20 2020
						</td>

					</tr>

					@foreach($replies as $reply)
						<tr>
							<td>
								<h3> {{ $thread->title }} </h3>
								{{-- av {{ $user->name}} {{thread->created_at}} --}}
								{{-- <br> --}}
								{{ $reply->body }}

							</td>
							<td>
								{{-- {{ $user->avatar }} kommer troligtvis inte användas --}}
								{{-- <br> --}}
								{{-- {{ $user->name }} --}}
								{{-- <br> --}}
								{{-- {{ $user->role }} --}}
								{{-- <br> --}}
								{{-- {{ $user->posts }} --}}
								{{-- <br> --}}
								{{-- Medlem sen: {{ $user->created_at }} --}}

								test
								<br>
								admin
								<br>
								Inlägg: 2
								<br>
								Medlem sedan: Mon Nov 20 2020
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>


		@endif


@endsection

