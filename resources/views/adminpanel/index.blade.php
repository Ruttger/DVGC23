@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Administration panel</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div >
                    <h3>Accounts</h3>
                    @if(count($users) > 0)
                        @if(Auth::user()->role == 'admin')
                            <h5>Admins</h5>
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created at</th>
                                </tr>
                                @foreach($users as $user)
                                    @if($user->role == 'admin')
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>
                                                {!! Form::open(['action' => ['AdminpanelController@destroy', $user->id], 'method' => 'POST']) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        @endif
                        <h5>Agents</h5>
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created at</th>
                            </tr>
                            @foreach($users as $user)
                                @if($user->role == 'agent')
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->created_at}}</td>
                                        @if(Auth::user()->role == 'admin')
                                            <td>
                                                {!! Form::open(['action' => ['AdminpanelController@destroy', $user->id], 'method' => 'POST']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!! Form::close() !!}
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </table>

                        <h5>Users</h5>
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created at</th>
                            </tr>
                            @foreach($users as $user)
                                @if($user->role == 'user')
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->created_at}}</td>
                                        @if(Auth::user()->role == 'admin')
                                            <td><a href="/adminpanel/{{$user->id}}/update" class="btn btn-link">Make agent</a></td>
                                            <td>
                                                {!! Form::open(['action' => ['AdminpanelController@destroy', $user->id], 'method' => 'POST']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                                {!! Form::close() !!}
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    @else
                        <p>There are no registered accounts.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
