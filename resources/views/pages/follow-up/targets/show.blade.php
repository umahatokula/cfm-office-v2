@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Life Coaches</h1>
                <span>List of all Life Coaches</span>
            </div>
            <div class="page-description-actions">
                <a href="#" class="btn btn-dark"><i class="material-icons-outlined">file_download</i>Download</a>
                <a href="#" class="btn btn-primary"><i class="material-icons">add</i>Create</a>
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
                    <div class="col-12">
                        <p class="card-description">{{$followupTarget->fname}}</p>
                        <p class="card-description">{{$followupTarget->email}}</p>
                        <p class="card-description">{{$followupTarget->phone}}</p>
                        <p class="card-description">{{$followupTarget->status}}</p>
                        <p class="card-description">{{$followupTarget->church_id}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection