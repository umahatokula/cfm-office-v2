@extends('master')
@section('body')

<div class="content-wrapper">
  <div class="page-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Service Teams</h1>
    </div>
    <div>
      <!-- <ul class="breadcrumb">
        <li><i class="fa fa-home fa-lg"></i></li>
        <li><a href="#">Blank Page</a></li>
      </ul> -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" data-toggle="table">
                  <thead>
                    <tr>
                      <th class="no-sorting text-center">
                        #
                      </th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Description</th>
                      <th class="text-center">Leader</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>

                  <tbody class="middle-align">
                    @foreach($serviceTeams as $serviceTeam)
                    <tr id="tr_{{$serviceTeam->id}}">
                      <td class="text-center">
                        {{$loop->iteration}}
                      </td>
                      <td>{{ $serviceTeam->name }}</td>
                      <td>{{ $serviceTeam->description }}</td>
                      <td>
                        @if($serviceTeam->leader)
                        {{ $serviceTeam->ServiceTeamleader->fname }} {{ $serviceTeam->ServiceTeamleader->lname }}
                        @endif
                      </td>
                      <td class="text-center">
                        <a href="{!! route('service-teams.edit', array($serviceTeam->id)) !!}" class="btn btn-success btn-sm btn-icon icon-left" data-toggle="modal" data-target="#myModal">
                          Edit
                        </a>

                        <a href="{{ route('service-teams.delete', array($serviceTeam->id)) }}" class="btn btn-danger btn-sm btn-icon icon-left"
                         data-tr="tr_{{$serviceTeam->id}}"
                         data-toggle="confirmation"
                         data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                         data-btn-ok-class="btn btn-sm btn-danger"
                         data-btn-cancel-label="Cancel"
                         data-btn-cancel-icon="fa fa-chevron-circle-left"
                         data-btn-cancel-class="btn btn-sm btn-default"
                         data-title="Are you sure you want to delete ?"
                         data-placement="left" data-singleton="true">
                         Delete
                       </a>
                     </td>
                   </tr>
                   @endforeach
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            {!! Form::open(array('route' => 'service-teams.store', 'class' => '', 'role' => 'form')) !!}

            <div class="form-group">
              {!! Form::label('name', 'Name', ['class' => 'control-label', 'for' => 'name']) !!}

              {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}

            </div>

            <div class="form-group-separator"></div>

            <div class="form-group">
              {!! Form::label('description', 'Description', ['class' => 'control-label', 'for' => 'description']) !!}

              {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'required']) !!}

            </div>

            <div class="form-group-separator"></div>

            <div class="form-group">
              {!! Form::label('leader', 'Leader', ['class' => 'control-label', 'for' => 'leader']) !!}

              {!! Form::select('leader', $members, null, ['class' => 'form-control', 'id' => 'leader', 'placeholder' => 'Select one', 'required']) !!}

            </div>

            <div class="form-group-separator"></div>

            <div class="form-group">

              {!! Form::submit('Create Service Team', ['class' => 'btn btn-primary', 'id' => 'add-user']) !!}

            </div>

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@stop

@section('page_js')
<script type="text/javascript">
  $(document).ready(function () {
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
  });
</script>
@endsection

