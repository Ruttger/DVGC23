

@extends('layouts.app')

@section('marker')
	<div class="topnav">
        <a href="/">Home</a>
        <a class="active" href="/forum">Forum</a>
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
	<h1> Forum </h1>
@endsection  

</style>
@section('content')
	<?php $user_role = 'admin'; ?>
		<!-- Coming from Category -->
	@if($from == 'category')
		<p> Categories and subforums </p>
		@if(count($categories) > 0)
			@foreach($categories as $category)
				@if($user_role == 'user' AND $category->rights != 'user')
					
				@else 
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

											@if(Auth::check() && Auth::user()->role == 'admin')
												<br>
												<form action="/forum/{{ $forum->id }}/delete" method="post">
													@csrf
													<input type="submit" value="Ta bort forum">
												</form>
											@endif
										<!-- slut OM admin -->
										</td>
												
										<td>
											<h3> {{ $forum->num_threads }} </h3>
										</td>
										<td>
											<h3> {{ $forum->num_views }} </h3>
										</td>
										<?php $latest = 0; ?>
										@foreach($threads as $thread)
											@if($forum->latest_thread == $thread->id)
												<td class="category_forum">
													<a href="/forum/{{$forum->id}}/thread/{{$thread->id}}">
														<h3> {{ $thread->title }} </h3>
													</a> <br>
													<h3> {{ $thread->updated_at }} </h3>
												</td>
												<?php $latest = 1; ?>									
											@endif
										@endforeach
										@if($latest == 0)
											<td>
												<h3> Ingen </h3>
											</td>
										@endif	
									</tr>
								@endif
							@endforeach
							<!-- Om inloggad och Admin -->
							@if( Auth::check() && Auth::user()->role == "admin" ) 
								<tr> 
									<td colspan="4">
										<form action="/forum/{{$category->id}}/create_forum" method="post">
											@csrf
											<input type="submit" value="Nytt Forum">
										</form>

									</td>
								</tr>
							@endif
							<!-- Slut Om Admin -->
						</tbody>
					</table>
				@endif
			@endforeach
		@else
			<h3> No categories... </h3>
		@endif
	@endif

		<!-- Coming from Forum -->
	@if($from == 'forum')
		<p> Specific Forum and Threads </p>
		@if($user_role == 'user' AND $forum->rights != 'user')
			
		@else 
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
										
										<!-- OM admin -->
										@if(Auth::check() && Auth::user()->role == "admin")
											<form action="/forum/{{ $thread->forum_id }}/thread/{{ $thread->id }}/delete" method="post">
												@csrf
												<input type="submit" value="Ta bort tråd">
											</form>
										@endif
										<!-- slut OM admin -->										
									</td>
												
									<td><h3> {{ $thread->num_replies }} </h3></td>
									<td><h3> {{ $thread->num_views }} </h3></td>
									<td>
										@foreach($latest_replies as $latest_reply)

											@if ($latest_reply->thread_id == $thread->id)
												<b> {{ $latest_reply->body }} </b>
												<br>
												<b> {{ $latest_reply->updated_at }} </b>
											@endif
										@endforeach
									</td>
								</tr>
							@endif
						@endforeach
						<!-- Om inloggad och INTE bannad -->
						@if(Auth::check() && Auth::user()->banned != 1)
							<tr> 
								<td colspan="4">
									<!-- Skapa ny tråd -->
									<form action="/forum/{{ $forum->id }}/create_thread" method="post">
										@csrf
										<input type="submit" value="Ny tråd">
									</form>

								</td>
							</tr>
						@endif
					</tbody>
				</table>
			@else
				<h3> No threads... </h3>
				@if(Auth::check() && Auth::user()->banned != 1)
				<!-- Om inloggad och INTE bannad -->
					<table>
						<tr> 
							<td colspan="4">
								<form action="/forum/{{ $forum->id }}/create_thread" method="post">
									@csrf
									<input type="submit" value="Ny tråd">
								</form>
							</td>
						</tr>
					</table>
				@endif
				<!-- end If not banned -->			
			@endif
		@endif
	@endif


	<!-- Inlägg del -->

	<!-- Coming from Thread -->
	@if($from == 'thread')

		<p> Specific Post </p>
		<table class="threads">
			<thead></thead>
			<tbody>
				<tr>
					<!-- Original Post -->
					<td>

						<h3> {{ $thread->title }}  </h3>	
						{{ $thread->body }}
						<br> <br>
						<i><small> {{ $thread->created_at }} </small></i> 
					</td>
					<td>
						<!-- användar info -->
						<b>Användarnamn:</b> {{ $orignal_poster->name }} 
						<br> 
						<b>Kontotyp:</b> {{ $orignal_poster->role }} 
						<br> 
						<b>Inlägg:</b> {{ $orignal_poster->num_posts }} 
						<br> 
						<b>Medlem sendan:</b> {{ $orignal_poster->created_at }} 
					</td>

				</tr>
					
				@foreach($replies as $reply)
					@foreach($repliers as $replier)
						@if($replier->id == $reply->user_id)
							<tr>
								<!-- Svar -->
								<td>
									<h3> {{ $thread->title }} </h3>	
									{{ $reply->body }}
									<br> <br>
									<i><small> {{ $reply->created_at }} </small></i> 
									<!-- Om inloggad och admin -->
									@if(Auth::check() && Auth::user()->role = 1)
										<form action="/forum/reply/{{ $reply->id }}/delete" method="post">
											@csrf
											<input type="submit" value="Ta bort svar">
										</form>
									@endif
								</td>
								<td> 
									<b>Användarnamn:</b> {{ $replier->name }} 
									<br>
									<b>Användartyp:</b> {{ $replier->role }} 
									<br>
									<b>Inlägg:</b> {{ $replier->num_posts }} 
									<br>
									<b>Medlem sen:</b> {{ $replier->created_at }}  
								</td>
							</tr>
						@endif
						@endforeach
				@endforeach
				<!-- Om inloggad och INTE bannad -->
				@if(Auth::check() && Auth::user()->banned != 1)
					<tr> 
						<td colspan="4">
							<form action="/forum/{{ $thread->forum_id }}/thread/{{ $thread->id }}/create_reply" method="post">
								@csrf
								<input type="submit" value="Svara">
							</form>
						</td>
					</tr>
				@endif
				<!-- End if -->
			</tbody>
		</table>
		@endif

	
@endsection  

