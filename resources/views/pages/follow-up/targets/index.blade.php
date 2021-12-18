@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Followup Targets</h1>
                <span>List of all Followup Targets</span>
            </div>
            <div class="page-description-actions">
                <a href="#" class="btn btn-dark"><i class="material-icons-outlined">file_download</i>Download</a>
                <a href="{{ route('followup-targets.create') }}" class="btn btn-primary"><i class="material-icons">add</i>Create</a>
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

                @if(count($errors) > 0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <ul class="p-0 m-0" style="list-style: none;">
                      @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                      @endforeach
                  </ul>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Church</th>
                                <th class="text-center" scope="col">Assigned To</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($followupTargets as $key => $followupTarget)
                            <tr>
                                <th scope="row"> {{ $key+1 }} </th>
                                <td> {{ $followupTarget->name }} </td>
                                <td> {{ $followupTarget->phone }} </td>
                                <td> {{ $followupTarget->church->name }} </td>
                                <td class="text-center">
                                    @forelse ( $followupTarget->lifecoaches as $lifecoaches)
                                        {{ $lifecoaches->name }}
                                    @empty
                                        <p>--</p>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('followup-targets.assign', $followupTarget) }}" href="#" class="text-dark p-0" data-bs-toggle="modal" data-bs-target="#modal-large">
                                        <span class="material-icons-outlined">add_link</span>
                                    </a>
                                    <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('followup-targets.show', $followupTarget) }}" href="#" class="text-primary p-0" data-bs-toggle="modal" data-bs-target="#modal-large">
                                        <span class="material-icons-outlined">visibility</span>
                                    </a>
                                    <a href="{{ route('followup-targets.edit', $followupTarget)}}" class="text-success p-0" data-original-title="" title="Delete">
                                        <span class="material-icons-outlined">edit</span>
                                    </a>
                                    <a href="{{ route('followup-targets.delete', $followupTarget)}}" class="text-danger p-0" data-original-title="" title="Delete">
                                        <span class="material-icons-outlined">delete</span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7">NO FOLLOW UP TARGET AVAILABLE</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $followupTargets->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
