@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>Chat Time-Frames</h3></div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    <div>
                        {!! Form::open(['action' => 'TimeFramesController@store', 'method' => 'POST']) !!}

                            <div class="form-group col-md-2">
                                {{Form::label('starts_at', 'Starts at:')}}
                                {{Form::date('starts_at_date', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
                                {{Form::time('starts_at_time', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
                            </div>

                        <div class="form-group col-md-2">
                            {{Form::label('expires_at', 'Expires at')}}
                            {{Form::date('expires_at_date', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
                            {{Form::time('expires_at_time', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
                        </div>

                            {{Form::submit('Add Time-Frame', ['class' => 'btn btn-primary'])}}
                        {!! Form::close() !!}
                        <hr>
                    </div>
                    <table class="table table-striped table-hover col-md-8">
                    <thead>
                        <tr>
                            <td>Starts at:</td>
                            <td>Expires at:</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeFrames as $timeFrame)
                            <tr>
                                <td>{{$timeFrame->starts_at}}</td>
                                <td>{{$timeFrame->expires_at}}</td>
                                    <td>
                                        {!! Form::open(['action' => ['TimeFramesController@destroy', $timeFrame->id], 'method' => 'POST']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
