@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Settings</div>


                <div class="card-body">
                    {!! Form::open(['action' => ['SettingController@update', $setting->id], 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection





<!-- <html>
<body>
<form action="submit" method="POST" >
    @csrf
    <label>Date Start</label>
    <input type="datetime-local" name="starts_at" >

    <br><br>
    <label>Date End</label>
    <input type="datetime-local" name="expires_at" >

    <br><br>
    <button type="submit">submit data</button>
</form>
</body>
</html>



