@extends('layouts.app')
@section('content')

<div class="content-wrapper">
  <div class="page-title">
    <div>
      <h1><i class="fa fa-support "></i> Church Service - Search Results</h1>
      <!-- <p>Start a beautiful journey here</p> -->
    </div>
    <div>
      <!-- <ul class="breadcrumb">
        <li><i class="fa fa-home fa-lg"></i></li>
        <li><a href="#">Blank Page</a></li>
      </ul> -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <td class="text-center">#</td>
                      @if(Auth::user()->hasRole('generaloverseer') || Auth::user()->hasRole('coordinatorchurches'))
                      <td class="text-center">Church</td>
                      @endif
                      <td class="text-center">Service Type</td>
                      <td class="text-center">Service Date</td>
                      <td class="text-center">Atendance (Total)</td>
                      <td class="text-center">First Timers (Total)</td>
                      <td class="text-center">Total Offering ( &#8358 )</td>
                      <td class="text-center">Action(s)</td>
                    </tr>
                  </thead>
                  <tbody>
                    @if($churchServices->count() > 0)
                    @foreach($churchServices as $churchService)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      @if(Auth::user()->hasRole('generaloverseer') || Auth::user()->hasRole('coordinatorchurches'))
                      <td class="text-left">
                        @if($churchService->church)
                        {{ $churchService->church->name }}
                        @endif
                      </td>
                      @endif
                      <td>
                        @if($churchService->serviceType)
                        {{ $churchService->serviceType->service_type }}
                        @endif
                      </td>
                      <td class="text-center">{{ $churchService->service_date->toFormattedDateString() }}</td>
                      <td class="text-center">{{ $churchService->attendance_total }}</td>
                      <td class="text-center">{{ $churchService->first_timers_total }}</td>
                      <td class="text-center">{{ number_format($churchService->total_offering, 2) }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="#" data-toggle="dropdown" class="btn btn-xs btn-default dropdown-toggle">Actions <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li>
                              <a href="{{ route('church-services.edit', $churchService->id) }}" data-target="#myModal" data-toggle="modal">Edit</a>
                            </li>
                            <li><a href="{{ route('church-services.delete', $churchService->id) }}">Delete</a></li>
                            <li><a href="{{ route('church-services.head-pastor-approve', $churchService->id) }}">Approve</a></li>
                            <li><a href="#">More Info</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td colspan="8">No results</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @stop

  @section('page_css')

  @stop


  @section('page_js')
  @stop

