@extends('layouts.app')
@section('content')
<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Salary Schedules</h1>
                        <span>&nbsp;</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        &nbsp
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('salaries-schedules.create') }}" class="btn btn-success">Create Salary Schedule</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-style-light" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-style-light" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-start">Name</th>
                                    <th class="text-start">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $schedule)
                                    <tr>
                                        <td class="text-center"> {{ $loop->iteration }} </td>
                                        <td>
                                            {{$schedule->name}}
                                        </td>
                                        <td class="text-start"> <span class="badge bg-{{ $schedule->status ? 'primary' : 'danger' }}">{{ $schedule->status ? 'active' : 'disabled' }}</span>
                                        </td>
                                        <td class="text-center">

                                            <a href="{{ route('salaries-schedules.edit', $schedule) }}" class="text-success p-0"
                                                data-original-title="" title="Edit">
                                                <span class="material-icons-outlined">edit</span>
                                            </a>

                                            <a href="{{ route('salaries-schedules.destroy', $schedule) }}" class="text-danger p-0"
                                                data-original-title="" title="Delete" onclick="return confirm('Are you sure?');">
                                                <span class="material-icons-outlined">delete</span>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No schedules</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="row my-5">
                            <div class="col-12 d-flex justify-content-center">
                                {{ $schedules->links() }}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection