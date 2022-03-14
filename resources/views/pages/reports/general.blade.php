@extends('layouts.app')
@section('content')

<style type="text/css">
    td{
        border:1px solid #000;
    }

    tr td:last-child{
        width:1%;
        white-space:nowrap;
    }
</style>

<div class="">
    <div class="row d-print-none">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'reportsGeneral', 'method' => 'GET', 'class' => '', 'id' => '', 'role' => 'form']) !!}
                    <div class="row">
                            <div class="col-md-3 mb-1">
                                {!! Form::select('service_type_id', $serviceTypes, $service_type_id, array('class' => 'form-control',
                                'id' => 'service_type_id', 'placeholder' => 'Select one')) !!}
                            </div>
                            <div class="col-md-3 mb-1">
                                {!! Form::date('date_from', isset($date_from) ? $date_from : null, array('class' => 'form-control',
                                'id' => 'date_from', 'placeholder' => 'From')) !!}
                            </div>
                            <div class="col-md-3 mb-1">
                                {!! Form::date('date_to', isset($date_to) ? $date_to : null, array('class' => 'form-control',
                                'id' => 'date_to', 'placeholder' => 'To')) !!}
                            </div>
                            <div class="col-md-3 mb-1">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-lg btn-primary btn-block">Filter</button>
                                </div>
                            </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="col-12 text-center mb-4">
                        <h3>Christ Family Ministry</h3>
                        @if($date_from)
                        <h6 class="text-capitalize"> {{ $date_from ? Carbon\Carbon::parse($date_from)->toFormattedDateString() : '' }} - {{ $date_to ? Carbon\Carbon::parse($date_to)->toFormattedDateString() : '' }}</h6>
                        @endif
                        <h6>{{ $selectedService ? $selectedService->service_type : 'All services' }}</h6>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <table class="table table-bordered table-responsive-md table-striped">
                                <thead>
                                    <th class="text-left" id="">Church</th>
                                    <th class="text-center" id="">Total Attendance</th>
                                    <th class="text-center" id="">Average Attendance</th>
                                    <th class="text-center" id="">First Time Guests Total</th>
                                    <th class="text-center" id="">Born Again Total</th>
                                    <th class="text-right" id="">Offering (&#8358;)</th>
                                    <th class="text-right" id="">Tithes (&#8358;)</th>
                                </thead>
                                <tbody>
                                    @foreach($reports as $datum)
                                    <tr>
                                        <td>{{ $datum['church']->name }}</td>
                                        <td class="text-center">{{ number_format($datum['attendance_total']) }}</td>
                                        <td class="text-center">{{ number_format($datum['attendance_avg']) }}</td>
                                        <td class="text-center">{{ number_format($datum['first_timers_total']) }}</td>
                                        <td class="text-center">{{ number_format($datum['born_again_total']) }}</td>
                                        <td class="text-right">{{ number_format($datum['total_offering'], 2) }}</td>
                                        <td class="text-right">{{ number_format($datum['tithes'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr style="font-weight: bold">
                                        <td>All Churches</td>
                                        <td class="text-center">{{ number_format($ovarall_attendance_total) }}</td>
                                        <td class="text-center">{{ number_format($ovarall_attendance_avg) }}</td>
                                        <td class="text-center">{{ number_format($ovarall_first_timers_total) }}</td>
                                        <td class="text-center">{{ number_format($ovarall_born_again_total) }}</td>
                                        <td class="text-right">{{ number_format($ovarall_total_offering, 2) }}</td>
                                        <td class="text-right">{{ number_format($ovarall_tithes, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
