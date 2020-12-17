@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Administration panel</h3>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <a href="/adminpanel/accounts" class="btn btn-primary">Manage accounts</a>
            </div>
        </div>
    </div>
@endsection
