@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Accounting - Requisitions</h1>
                <span>Edit a requisition</span>
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
                <livewire:accounting.requisitions.edit-requisition :expenseHeads="$expenseHeads" :requisition="$requisition">
            </div>
        </div>
    </div>
</div>
@endsection