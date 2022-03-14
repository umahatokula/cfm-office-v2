@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Bank Details</h1>
                <span>&nbsp;</span>
            </div>
            <div class="page-description-actions">
                &nbsp;
            </div>
        </div>
    </div>
</div>

<livewire:staff-bank-details.create :staff="$staff">
    
@endsection

@push('scripts')

@endpush
