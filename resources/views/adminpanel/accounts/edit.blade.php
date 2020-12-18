@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Edit User</h3></div>
            <div class="card-body">
                {!! Form::open(['action' => ['AccountsController@update', $user->id], 'method' => 'POST']) !!}


                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
