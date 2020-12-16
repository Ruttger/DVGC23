@extends('layouts.app')

@section('content')
    <h1>
        <hr>
        {{$post->title}}
        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
                <a href="/website/public/posts/{{ $post->id }}/edit" class="btn btn-link">Edit</a>
            @endif
        @endif
    </h1>
    <hr>
    <div>
        {!! $post->body !!}
    </div>
    <hr>
    <small>Written on {{ $post->created_at }} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id || Auth::user()->role == 'admin')
        <h2>
            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}

            <!-- <a href="/seke/public/posts" class="btn btn-primary">Go back</a> -->
        </h2>
        @endif
    @endif
@endsection
