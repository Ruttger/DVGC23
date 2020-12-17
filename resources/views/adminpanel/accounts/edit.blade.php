@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Edit User</h3></div>
            <div class="card-body">
                {!! Form::open(['action' => ['AccountsController@update', $user->id], 'method' => 'POST']) !!}

                    <div class="form-group col-md-3">
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>

                    <div class="form-group col-md-3">
                        {{Form::label('email', 'E-mail')}}
                        {{Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'E-mail'])}}
                    </div>

                    <div class="form-group col-md-2">
                        {{Form::label('role', 'Role')}}
                        {{Form::select('role', ['admin' => 'Admin', 'agent' => 'Agent', 'user' => 'User'], $user->role, ['class' => 'form-control'])}}
                    </div>

                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
