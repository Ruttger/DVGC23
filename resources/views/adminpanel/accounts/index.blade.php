@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Accounts</h3></div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>
                                        <a data-toggle="collapse" href="#collapse1" class="btn">Admins</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Created at</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                        @if($user->role == 'admin')
                                                            <tr>
                                                                <td>{{$user->name}}</td>
                                                                <td>{{$user->email}}</td>
                                                                <td>{{$user->role}}</td>
                                                                <td>{{$user->created_at}}</td>
                                                                @if(Auth::user()->role == 'admin')
                                                                    <td>
                                                                        <a href="/adminpanel/accounts/{{$user->id}}/edit" class="btn btn-link">Edit</a>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading-">
                                    <h4>
                                        <a data-toggle="collapse" href="#collapse2" class="btn">Agents</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Created at</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                        @if($user->role == 'agent')
                                                            <tr>
                                                                <td>{{$user->name}}</td>
                                                                <td>{{$user->email}}</td>
                                                                <td>{{$user->role}}</td>
                                                                <td>{{$user->created_at}}</td>
                                                                @if(Auth::user()->role == 'admin')
                                                                    <td>
                                                                        <a href="/adminpanel/accounts/{{$user->id}}/edit" class="btn btn-link">Edit</a>
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::open(['action' => ['AccountsController@destroy', $user->id], 'method' => 'POST']) !!}
                                                                            {{Form::hidden('_method', 'DELETE')}}
                                                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                                        {!! Form::close() !!}
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading-">
                                    <h4>
                                        <a data-toggle="collapse" href="#collapse3" class="btn">Users</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Created at</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                        @if($user->role == 'user')
                                                            <tr>
                                                                <td>{{$user->name}}</td>
                                                                <td>{{$user->email}}</td>
                                                                <td>{{$user->role}}</td>
                                                                <td>{{$user->created_at}}</td>
                                                                @if(Auth::user()->role == 'admin')
                                                                    <td>
                                                                        <a href="/adminpanel/accounts/{{$user->id}}/edit" class="btn btn-link">Edit</a>
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::open(['action' => ['AccountsController@destroy', $user->id], 'method' => 'POST']) !!}
                                                                            {{Form::hidden('_method', 'DELETE')}}
                                                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                                        {!! Form::close() !!}
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                    <br>
                    <a href="/adminpanel/accounts/create" class="btn btn-primary">Create user</a>
            </div>
        </div>
    </div>
@endsection
