@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Configuration Update</div>

                <div class="card-body">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                    {!! Form::open(['action' => 'ConfigurationsController@update', 'method' => 'patch']) !!}
                        <div class="form-row">
                            {!! Form::label('number_of_recent', 'Retrieving Number Of Recent Movies') !!}
                            {!! Form::number('number_of_recent', $data['number_of_recent'], ['class'=>'form-control']) !!}
                        </div><br>
                        <div class="form-row">
                            {!! Form::label('top_rated', 'Retrieving Number Of Top Rated Movies') !!}
                            {!! Form::number('top_rated', $data['top_rated'], ['class'=>'form-control']) !!}
                        </div><br>
                        <div class="form-row">
                            {!! Form::label('interval_timer', 'Time Interval to run Queue (in days)') !!}
                            {!! Form::number('interval_timer', $data['interval_timer'], ['class'=>'form-control']) !!}
                        </div><br>
                        <div class="form-row">
                            {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
