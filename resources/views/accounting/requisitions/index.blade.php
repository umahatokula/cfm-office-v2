@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Accounting - Requisitions</h1>
                <span>List of requisitions</span>
            </div>
            <div class="page-description-actions">
                <a href="{{ route('requisitions.create') }}" class="btn btn-primary"><i class="material-icons">add</i>Create Requisition</a>
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
                <livewire:accounting.requisitions.list-requisitions>
            </div>
        </div>
    </div>
</div>
@endsection