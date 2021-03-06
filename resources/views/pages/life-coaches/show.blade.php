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
            <div class="card-body">
                
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-style-light" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="row my-3">
                    <div class="col-md-1"><b>Name</b></div>
                    <div class="col-md-8">{{ $lifeCoach->name  }}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-1"><b>Email</b></div>
                    <div class="col-md-8">{{ $lifeCoach->email }}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-1"><b>Phone</b></div>
                    <div class="col-md-8">{{ $lifeCoach->phone }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <h4>Targets</h4>
                    </div>
                    <div class="col-md-10 d-grid gap-2 d-md-flex justify-content-md-end">
                        <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('life-coaches.assign', $lifeCoach) }}" href="#" class="btn btn-dark m-b-xs" data-bs-toggle="modal" data-bs-target="#modal-large">Assign existing Target</a>

                        <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('life-coaches.create-target', $lifeCoach->id) }}" href="#" class="btn btn-primary m-b-xs" data-bs-toggle="modal" data-bs-target="#modal-large">Create & assign Target</a>
                    </div>
                    <div class="col-12">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-end">Action(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lifeCoach->followuptargets as $target)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>
                                        <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('followup-targets.show', $target) }}" href="#" class="text-primary p-0" data-bs-toggle="modal" data-bs-target="#modal-large">
                                            {{ $target->name }}
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('followup-reports.create', $target) }}" class="text-primary p-0" title="Report">
                                            <span class="material-icons-sharp">edit_note</span>
                                        </a>
                                        <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('life-coaches.assign', $target) }}" href="#" class="text-danger p-0" data-bs-toggle="modal" data-bs-target="#modal-large" title="Delete">
                                            <span class="material-icons-sharp">delete</span>
                                        </a>
                                        <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('life-coaches.assign', $target) }}" href="#" class="text-dark p-0" data-bs-toggle="modal" data-bs-target="#modal-large" title="More Actions">
                                            <span class="material-icons-sharp">more_vert</span>
                                        </a>
                                    </td>
                                </tr>                                    
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection
