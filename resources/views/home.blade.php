@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! your token is <strong class="text-success">{{$api_token}}</strong>
                    <div class="form-row">
                        <div class="form-check"><a href="{{route('updateToken')}}" class="btn btn-success">Update Token</a></div>
                        <div class="form-check"><a href="{{route('edit-config')}}" class="btn btn-primary">Update Configurations</a></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
