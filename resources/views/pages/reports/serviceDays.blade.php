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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-1 mb-lg-5 d-print-none">
                        <div class="col-md-6">
                            <h4>Church Services</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- <a href="{{ route('reportsChurchServicesPdf', [$first_date_from, $first_date_to, $second_date_from, $second_date_to]) }}" class="btn btn-danger"> PDF</a> -->
                            <p class="d-print-none">
                                <a href="#" class="" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter records</a>
                            </p>
                        </div>
                    </div>


                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <div class="collapse" id="collapseExample">
                      <div class="card card-body">

                        {!! Form::open(['route' => 'reportsServiceDays', 'method' => 'GET', 'class' => '', 'id' => 'churchServiceSearchForm', 'role' => 'form', 'files' => true]) !!}

                        @if(auth()->user()->can('view all churches') || auth()->user()->can('view own church'))
                        <div class="row mb-3 mb-lg-5">
                            <div class="col-md-3 mb-1 p-2">
                                1st date
                            </div>
                            <div class="col-md-3 mb-1">
                                {!! Form::date('first_date_from', isset($first_date_from) ? $first_date_from : null, array('class' => 'form-control',
                                'id' => 'first_date_from', 'placeholder' => 'From')) !!}
                            </div>
                            <div class="col-md-3 mb-1">
                                {!! Form::date('first_date_to', isset($first_date_to) ? $first_date_to : null, array('class' => 'form-control',
                                'id' => 'first_date_to', 'placeholder' => 'To')) !!}
                            </div>
                        </div>
                        <div class="row mb-3 mb-lg-5">
                            <div class="col-md-3 mb-1 p-2">
                                2nd date
                            </div>
                            <div class="col-md-3 mb-1">
                                {!! Form::date('second_date_from', isset($second_date_from) ? $second_date_from : null, array('class' => 'form-control',
                                'id' => 'second_date_from', 'placeholder' => 'From')) !!}
                            </div>
                            <div class="col-md-3 mb-1">
                                {!! Form::date('second_date_to', isset($second_date_to) ? $second_date_to : null, array('class' => 'form-control',
                                'id' => 'second_date_to', 'placeholder' => 'To')) !!}
                            </div>
                        </div>
                        <div class="row mb-3 mb-lg-5">
                            <div class="col-md-3 mb-1 p-2">
                                Type of service
                            </div>
                            <div class="col-md-3 mb-1">
                                {!! Form::select('service_type_id', $serviceTypes, $service_type_id, array('class' =>
                                'form-control',
                                'id' => 'service_type_id', 'placeholder' => 'All')) !!}
                            </div>
                            <div class="col-md-3 mb-1">
                                <button class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                        @endif
                        {!! Form::close() !!}
                      </div>
                    </div>

                    
                    <div class="col-12 text-left mb-4">
                        <p>Service Type: {{ $service_type ? $service_type->service_type : 'All' }}</p>
                        <p class="text-capitalize">1st date: {{ $first_date_from ? Carbon\Carbon::parse($first_date_from)->toFormattedDateString() : '' }} to {{ $first_date_to ? Carbon\Carbon::parse($first_date_to)->toFormattedDateString() : '' }}</p>

                        @if($second_date_from)
                        <p class="text-capitalize">2nd date: {{ $second_date_from ? Carbon\Carbon::parse($second_date_from)->toFormattedDateString() : '' }} to {{ $second_date_to ? Carbon\Carbon::parse($second_date_to)->toFormattedDateString() : '' }}</p>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            @if(count($combined_records) > 0)
                            <div class="table-responsive">
                               <table class="table table-bordered table-responsive table-striped" style="width: 100%;">
                                <thead>
                                    <th class="text-left">&nbsp</th>
                                    <th class="text-center" colspan="4">Attendance</th>
                                    <th class="text-center">First-time Guests</th>
                                    <th class="text-center">Born Again</th>
                                    <th class="text-right">Offering (&#8358;)</th>
                                    <th class="text-right">Tithe (&#8358;)</th>
                                    <th class="text-right">Total (&#8358;)</th>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-left">&nbsp</td>
                                        <td class="text-center">Men</td>
                                        <td class="text-center">Women</td>
                                        <td class="text-center">Children</td>
                                        <td class="text-center">Total</td>
                                        <td>&nbsp</td>
                                        <td>&nbsp</td>
                                        <td>&nbsp</td>
                                        <td>&nbsp</td>
                                        <td>&nbsp</td>
                                    </tr>

                                    @foreach($combined_records as $churchName => $record)
                                    <tr>
                                        <td>{{ $churchName }}</td>
                                        <td colspan="10">&nbsp</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">{{ $first_date_from ? Carbon\Carbon::parse($first_date_from)->toFormattedDateString() : '' }} - {{ $first_date_to ? Carbon\Carbon::parse($first_date_to)->toFormattedDateString() : '' }}</td>
                                        <td class="text-center">{{ $record['first_records']['attendance_men'] }}</td>
                                        <td class="text-center">{{ $record['first_records']['attendance_women'] }}</td>
                                        <td class="text-center">{{ $record['first_records']['attendance_children'] }}</td>
                                        <td class="text-center">{{ $record['first_records']['attendance_total'] }}</td>
                                        <td class="text-center">{{ $record['first_records']['first_timers_total'] }}</td>
                                        <td class="text-center">{{ $record['first_records']['born_again_total'] }}</td>
                                        <td class="text-right">{{ number_format($record['first_records']['offering'], 2) }}</td>
                                        <td class="text-right">{{ number_format($record['first_records']['tithes'], 2) }}</td>
                                        <td class="text-right">{{ number_format($record['first_records']['total'], 2) }}</td>
                                    </tr>
                                    @if(isset($second_date_from))
                                    <tr>
                                        <td class="text-left">{{ $second_date_from ? Carbon\Carbon::parse($second_date_from)->toFormattedDateString() : '' }} - {{ $second_date_to ? Carbon\Carbon::parse($second_date_to)->toFormattedDateString() : '' }}</td>
                                        <td class="text-center">{{ $record['second_records']['attendance_men'] }}</td>
                                        <td class="text-center">{{ $record['second_records']['attendance_women'] }}</td>
                                        <td class="text-center">{{ $record['second_records']['attendance_children'] }}</td>
                                        <td class="text-center">{{ $record['second_records']['attendance_total'] }}</td>
                                        <td class="text-center">{{ $record['second_records']['first_timers_total'] }}</td>
                                        <td class="text-center">{{ $record['second_records']['born_again_total'] }}</td>
                                        <td class="text-right">{{ number_format($record['second_records']['offering'], 2) }}</td>
                                        <td class="text-right">{{ number_format($record['second_records']['tithes'], 2) }}</td>
                                        <td class="text-right">{{ number_format($record['second_records']['total'], 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="10">&nbsp</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                            </div>
                            
                            @else
                            <p>No records</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
