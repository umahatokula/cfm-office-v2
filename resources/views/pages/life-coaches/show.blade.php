@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Life Coach Dashboard</h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">&nbsp</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="page-description">
                            <h1>{{ $lifeCoach->name }}'s</h1>
                            <span>{{$lifeCoach->email}}</span>
                            <span>{{$lifeCoach->phone}}</span>
                        </div>
                        <div class="card-header">
                            <h5 class="card-title">{{ $lifeCoach->lname }}</h5>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-description">{{$lifeCoach->email}}</p>
                                <p class="card-description">{{$lifeCoach->phone}}</p>
                                <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('followup-targets.create') }}" href="#" class="btn btn-primary m-b-sm" data-bs-toggle="modal" data-bs-target="#modal-large">Create Targets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
