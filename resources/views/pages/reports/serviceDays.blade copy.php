@extends('frontend.layouts.app')
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

                    <div class="row mb-5 d-print-none">
                        <div class="col-md-6">
                            <h4>Church Services</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('reportsChurchServicesPdf', [$first_date_from, $first_date_to, $second_date_from, $second_date_to]) }}" class="btn btn-danger"> PDF</a>
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


                    <p class="d-print-none">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Click here to filter results
                      </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                      <div class="card card-body">

                        {!! Form::open(['route' => 'reportsServiceDays', 'method' => 'GET', 'class' => '', 'id' => 'churchServiceSearchForm', 'role' => 'form', 'files' => true]) !!}

                        @if(auth()->user()->can('view all churches') || auth()->user()->can('view own church'))
                        <div class="row mb-5">
                            <div class="col-md-2 mb-1 p-2">
                                Compare
                            </div>
                            <div class="col-md-5 mb-1">
                                {!! Form::date('first_date_from', isset($first_date_from) ? $first_date_from : null, array('class' => 'form-control',
                                'id' => 'first_date_from', 'placeholder' => 'From')) !!}
                            </div>
                            <div class="col-md-5 mb-1">
                                {!! Form::date('first_date_to', isset($first_date_to) ? $first_date_to : null, array('class' => 'form-control',
                                'id' => 'first_date_to', 'placeholder' => 'To')) !!}
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-2 mb-1 p-2">
                                With
                            </div>
                            <div class="col-md-5 mb-1">
                                {!! Form::date('second_date_from', isset($second_date_from) ? $second_date_from : null, array('class' => 'form-control',
                                'id' => 'second_date_from', 'placeholder' => 'From')) !!}
                            </div>
                            <div class="col-md-5 mb-1">
                                {!! Form::date('second_date_to', isset($second_date_to) ? $second_date_to : null, array('class' => 'form-control',
                                'id' => 'second_date_to', 'placeholder' => 'To')) !!}
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12 mb-1">
                                <button class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                        @endif
                        {!! Form::close() !!}
                      </div>
                    </div>

                    
                    <div class="col-12 text-center text-capitalize mb-4">
                        <h4>Results for: {{ $first_date_from ? Carbon\Carbon::parse($first_date_from)->toFormattedDateString() : '' }} to {{ $first_date_to ? Carbon\Carbon::parse($first_date_to)->toFormattedDateString() : '' }}</h4>

                        @if($second_date_from)
                        <br>
                        <h4>Compared with: {{ $second_date_from ? Carbon\Carbon::parse($second_date_from)->toFormattedDateString() : '' }} to {{ $second_date_to ? Carbon\Carbon::parse($second_date_to)->toFormattedDateString() : '' }}</h4>
                        @endif
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            @if(count($combined_records) > 0)
                            <table class="table table-bordered table-responsive table-striped" style="width: 100%;">
                                <thead>
                                    <th class="text-left" style="border: 1px solid #000;">Church</th>
                                    <th class="text-center" colspan="{{ isset($second_date_from) ? '2' : '1' }}" style="border: 1px solid #000;">Attendance</th>
                                    <th class="text-center" colspan="{{ isset($second_date_from) ? '2' : '1' }}" style="border: 1px solid #000;">Children</th>
                                    <th class="text-center" colspan="{{ isset($second_date_from) ? '2' : '1' }}" style="border: 1px solid #000;">First-time Guests</th>
                                    <th class="text-center" colspan="{{ isset($second_date_from) ? '2' : '1' }}" style="border: 1px solid #000;">Born Again</th>
                                    <th class="text-right" colspan="{{ isset($second_date_from) ? '2' : '1' }}" style="border: 1px solid #000;">Offering (&#8358;)</th>
                                    <th class="text-right" colspan="{{ isset($second_date_from) ? '2' : '1' }}" style="border: 1px solid #000;">Tithe (&#8358;)</th>
                                    <th class="text-right" colspan="{{ isset($second_date_from) ? '2' : '1' }}" style="border: 1px solid #000;">Total (&#8358;)</th>
                                </thead>
                                <tbody>

                                    @if(isset($second_date_from))
                                    <tr>                                        
                                        <td class="text-center" style="border-left: 1px solid #000; border-right: 1px solid #000;">&nbsp</td>
                                        <td class="text-center">Q 1</td>
                                        <td class="text-center" style="border-right: 1px solid #000;">Q 2</td>

                                        <td class="text-center">Q 1</td>
                                        <td class="text-center" style="border-right: 1px solid #000;">Q 2</td>

                                        <td class="text-center">Q 1</td>
                                        <td class="text-center" style="border-right: 1px solid #000;">Q 2</td>

                                        <td class="text-center">Q 1</td>
                                        <td class="text-center" style="border-right: 1px solid #000;">Q 2</td>

                                        <td class="text-center">Q 1</td>
                                        <td class="text-center" style="border-right: 1px solid #000;">Q 2</td>

                                        <td class="text-center">Q 1</td>
                                        <td class="text-center" style="border-right: 1px solid #000;">Q 2</td>

                                        <td class="text-center">Q 1</td>
                                        <td class="text-center" style="border-right: 1px solid #000;">Q 2</td>
                                    </tr>
                                    @endif

                                    @foreach($combined_records as $churchName => $record)
                                    <tr>
                                        <td class="text-left" style="border-left: 1px solid #000; border-right: 1px solid #000;">{{ $churchName }}</td>

                                        <td class="text-center">{{ $record['first_records']['attendance'] }}</td>

                                        <?php if(isset($second_date_from)) { ?> <td class="text-center" style="border-right: 1px solid #000;">{{ $record['second_records']['attendance'] }}</td> <?php } ?>

                                        <td class="text-center">{{ $record['first_records']['children'] }}</td>

                                        <?php if(isset($second_date_from)) { ?> <td class="text-center" style="border-right: 1px solid #000;">{{ $record['second_records']['children'] }}</td> <?php } ?>

                                        <td class="text-center">{{ $record['first_records']['first_timers_total'] }}</td>

                                        <?php if(isset($second_date_from)) { ?> <td class="text-center" style="border-right: 1px solid #000;">{{ $record['second_records']['first_timers_total'] }}</td> <?php } ?>

                                        <td class="text-center">{{ $record['first_records']['born_again_total'] }}</td>

                                        <?php if(isset($second_date_from)) { ?> <td class="text-center" style="border-right: 1px solid #000;">{{ $record['second_records']['born_again_total'] }}</td> <?php } ?>

                                        <td class="text-right">{{ number_format($record['first_records']['offering'], 2) }}</td>

                                        <?php if(isset($second_date_from)) { ?> <td class="text-right" style="border-right: 1px solid #000;">{{ number_format($record['second_records']['offering'], 2) }}</td> <?php } ?>

                                        <td class="text-right">{{ number_format($record['first_records']['tithes'], 2) }}</td>

                                        <?php if(isset($second_date_from)) { ?> <td class="text-right" style="border-right: 1px solid #000;">{{ number_format($record['second_records']['tithes'], 2) }}</td> <?php } ?>

                                        <td class="text-right">{{ number_format($record['first_records']['total'], 2) }}</td>

                                        <?php if(isset($second_date_from)) { ?> <td class="text-right" style="border-right: 1px solid #000;">{{ number_format($record['second_records']['total'], 2) }}</td> <?php } ?>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
