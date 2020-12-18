@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Administration panel</h3></div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <ul class="list-group">
                    <li class="list-group-item"><a href="/adminpanel/accounts" class="btn btn-primary">Manage Accounts</a></li>
                    <li class="list-group-item"><a href="/adminpanel/timeframes" class="btn btn-primary">Manage Chat time-frames</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
