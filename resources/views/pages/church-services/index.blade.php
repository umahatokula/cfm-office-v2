@extends('layouts.app')
@section('content')

<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h3>Church Services</h3>
                        </div>
                        <div class="col-md-6 justify-content-end d-flex pt-4">
                            <a href="{{ route('church-services.pdf', [$date_from, $date_to, $service_type_id, $church_id]) }}"
                                class="btn btn-danger mx-2"> PDF</a>
                            <a href="{{ route('church-services.create') }}" class="btn btn-success mx-2"> New Record</a>
                        </div>
                    </div>


                    <h4>Filter result</h4>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {!! Form::open(['route' => 'church-services.index', 'method' => 'GET', 'class' => '', 'id' =>
                    'churchServiceSearchForm', 'role' => 'form', 'files' => true]) !!}

                    @if(auth()->user()->can('view all churches') || auth()->user()->can('view own church'))
                    <div class="row mb-5">
                        @if(auth()->user()->can('view all churches'))
                        <div class="col-md-3 mb-1">
                            {!! Form::select('church_id', $churches, $church_id, array('class' => 'form-control',
                            'id' => 'church_id', 'placeholder' => 'select church')) !!}
                        </div>
                        @endif
                        <div class="col-md-3 mb-1">
                            {!! Form::select('service_type_id', $serviceTypes, $service_type_id, array('class' =>
                            'form-control',
                            'id' => 'service_type_id', 'placeholder' => 'select service type')) !!}
                        </div>
                        <div class="col-md-2 mb-1">
                            {!! Form::date('date_from', $date_from, array('class' => 'form-control',
                            'id' => 'date_from', 'placeholder' => 'From')) !!}
                        </div>
                        <div class="col-md-2 mb-1">
                            {!! Form::date('date_to', $date_to, array('class' => 'form-control',
                            'id' => 'date_to', 'placeholder' => 'To')) !!}
                        </div>
                        <div class="col-md-2 mb-1">
                          <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block">Filter</button>
                          </div>
                        </div>
                    </div>
                    @endif
                    {!! Form::close() !!}

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-light">
                                    <tr>
                                        <thead>
                                            <th class="text-center">#</th>
                                            <th>Service Date</th>
                                            @can('view all churches')
                                            <th>Church</th>
                                            @endcan
                                            <th>Type</th>
                                            <th class="text-center">Attendance</th>
                                            <th class="text-center">First Time Guests</th>
                                            <th class="text-center">Born Again</th>
                                            <th class="text-right">Offering (&#8358;)</th>
                                            <th class="text-center">Action(s)</th>
                                        </thead>
                                    </tr>
                                    <tbody>
                                        @php
                                        $totalAttendance = 0;
                                        $totalFirstTimers = 0;
                                        $totalBornAgain = 0;
                                        $totalOffering = 0;
                                        @endphp
                                        @forelse($churchServices as $churchService)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $churchService->service_date ?  $churchService->service_date->toFormattedDateString() : '' }}
                                            </td>
                                            @can('view all churches')
                                            <td>{{ $churchService->church ? $churchService->church->name : '' }}</td>
                                            @endcan
                                            <td>{{ $churchService->serviceType->service_type }}</td>
                                            <td class="text-center">{{ $churchService->attendance_total }}</td>
                                            <td class="text-center">{{ $churchService->first_timers_total }}</td>
                                            <td class="text-center">{{ $churchService->born_again_total }}</td>
                                            <td class="text-right">{{ number_format($churchService->total_offering, 2) }}
                                            </td>
                                            <td class="text-center">
                                                
    
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <li>
                                                                <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('church-services.show', $churchService->id) }}" href="#" class="dropdown-item" class="text-danger p-0" data-bs-toggle="modal" data-bs-target="#modal-large" title="Delete">View</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('church-services.edit', $churchService->id) }}" class="dropdown-item"
                                                                    data-toggle="modal" data-target="#fixedModal">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('church-services.delete', $churchService->id) }}" class="dropdown-item"
                                                                    data-toggle="modal" data-target="#fixedModal">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
    
    
                                            </td>
                                        </tr>
                                        @php
                                        $totalAttendance += $churchService->attendance_total;
                                        $totalFirstTimers += $churchService->first_timers_total;
                                        $totalBornAgain += $churchService->born_again_total;
                                        $totalOffering += $churchService->total_offering;
                                        @endphp
                                        @empty
                                        <tr>
                                            <td colspan="8">No records</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            @if(auth()->user()->can('view all churches'))
                                            <td class="text-center" colspan="4"><b>Total</b></td>
                                            @else
                                            <td class="text-center" colspan="3"><b>Total</b></td>
                                            @endif
                                            <td class="text-center"><b>{{ $totalAttendance }}</b></td>
                                            <td class="text-center"><b>{{ $totalFirstTimers }}</b></td>
                                            <td class="text-center"><b>{{ $totalBornAgain }}</b></td>
                                            <td class="text-right"><b>{{ number_format($totalOffering, 2) }}</b></td>
                                            <td class="text-center">&nbsp</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
