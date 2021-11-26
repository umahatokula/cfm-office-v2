@extends('frontend.layouts.app')
@section('content')

<div class="content-wrapper">
  <div class="page-title">
    <div>
      <h1><i class="fa fa-bullseye"></i> Church Service</h1>
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
          <div class="row text-center">
            <div class="col-xs-12">
              <h3>Church Services - Search</h3>
            </div>
            <div class="col-xs-12">
              <a href="{{ route('church-services.create') }}" class="btn btn-default btn-sm" data-target="#myModal" data-toggle="modal"><i class="fa fa-plus-square"></i> New Record</a>
            </div>
          </div>

          <hr>
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          {!! Form::open(['route' => 'church-services.search', 'method' => 'POST', 'class' => '', 'id' => 'churchServiceSearchForm', 'role' => 'form', 'files' => true]) !!}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                {!! Form::select('service_type_id', $serviceTypes, null, array('class' => 'form-control', 'id' => 'service_type_id', 'placeholder' => 'select service type')) !!}
              </div>
            </div>
            <div class="col-md-9 text-left">
              <div class="btn-group">
                <button class="btn btn-xs btn-info"><i class="fa fa-search"></i> Search</button>
                <a class="btn btn-xs btn-default" id="clear"><i class="fa fa-times"></i> Clear</a>
                <div class="btn-group">
                  <a href="#" data-toggle="dropdown" class="btn btn-xs btn-default dropdown-toggle"><i class="fa fa-reorder"></i> Quick Searches <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('follow-up.search-need-attention') }}">Records needing attention</a></li>
                    <li><a href="{{ route('follow-up.search-added-last-week') }}">Added in the last week</a></li>
                    <li><a href="{{ route('follow-up.search-updated-last-week') }}">Changed in the last week</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  @if(session('churchServices'))
  <?php $churchServices = session('churchServices'); ?>

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
                    <tr id="tr_{{$churchService->id}}">
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
                            <li><a href="{{ route('church-services.delete', $churchService->id) }}"
                             data-tr="tr_{{$churchService->id}}"
                             data-toggle="confirmation"
                             data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                             data-btn-ok-class="btn btn-sm btn-danger"
                             data-btn-cancel-label="Cancel"
                             data-btn-cancel-icon="fa fa-chevron-circle-left"
                             data-btn-cancel-class="btn btn-sm btn-default"
                             data-title="Are you sure you want to delete ?"
                             data-placement="left" data-singleton="true">Delete</a></li>
                             @if(\Auth::user()->hasRole('generaloverseer') || \Auth::user()->hasRole('coordinatorchurches'))
                             <li><a href="{{ route('church-services.head-pastor-approve', $churchService->id) }}">Approve</a></li>
                             @endif
                             {{-- <li><a href="#">More Info</a></li> --}}
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
  
  @endif


</div>
@stop

@section('page_css')

@stop


@section('page_js')
<script type="text/javascript">
  $(document).ready(function() {

    $('[data-toggle=confirmation]').confirmation({
      rootSelector: '[data-toggle=confirmation]',
      onConfirm: function (event, element) {
        element.trigger('confirm');
      }
    });

    $(document).on('confirm', function (e) {
      var ele = e.target;
      e.preventDefault();

      $.ajax({
        url: ele.href,
        type: 'DELETE',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
          if (data['success']) {
            $("#" + data['tr']).slideUp("slow");
            alert(data['success']);
          } else if (data['error']) {
            alert(data['error']);
          } else {
            alert('Whoops Something went wrong!!');
          }
        },
        error: function (data) {
          alert(data.responseText);
        }
      });

      return false;
    });

    //reset form fields
    $('#clear').click(function() {
      $('#churchServiceForm')[0].reset();
    });

  }); 
</script>
@stop

