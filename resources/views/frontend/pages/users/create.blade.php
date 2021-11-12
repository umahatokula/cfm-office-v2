@extends('master')
@section('body')

<div class="content-wrapper">
  <div class="page-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Users</h1>
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
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example-2">
                  <thead>
                    <tr>
                      <th class="no-sorting text-center">
                        #
                      </th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Role(s)</th>
                      <th class="text-center">Church</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>

                  <tbody class="middle-align">
                    <?php 
                    $count=1;
                //dd($users); 
                    ?>
                    @foreach($users as $user)
                    <tr id="tr_{{$user->id}}">
                      <td class="text-center">
                        {{$count}}
                      </td>
                      <td>
                        @if($user->member)
                        {!! ($user->member->fname.' '.$user->member->lname) !!}
                        @endif
                      </td>
                      <td>
                        @foreach($user->roles  as $role)
                        {!! $role->name  !!}<br>
                        @endforeach
                      </td>
                      <td>
                        @if($user->member->church)
                        {!! $user->member->church->name !!}
                        @endif
                      </td>
                      <td class="text-center">
                        <a href="{!! route('users.edit', array($user->id)) !!}" class="btn btn-success btn-sm btn-icon icon-left" data-toggle="modal" data-target="#myModal">
                          Edit
                        </a>

                        <a href="{{ route('users.delete', array($user->id)) }}" class="btn btn-danger btn-sm btn-icon icon-left"
                         data-tr="tr_{{$user->id}}"
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

                        <a href="{!! route('users.show', $user->id) !!}" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                          Profile
                        </a>
                      </td>
                    </tr>
                    <?php $count++; ?>
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

              {!! Form::open(array('route' => 'users.store', 'class' => '', 'role' => 'form')) !!}

              <div class="form-group">
                {!! Form::label('member_id', 'Member', array('class' => 'control-label', 'for' => 'member_id')) !!}

                {!! Form::select('member_id', $members, null, ['class' => 'form-control select', 'placeholder' => 'Select one', 'id' => 'member_id', 'required', 'style' => 'width:100%']) !!}

              </div>

              <div class="form-group-separator"></div>

              <div class="form-group">
                {!! Form::label('password', 'Password', array('class' => 'control-label', 'for' => 'password')) !!}

                {!! Form::password('password', array('class' => 'form-control', 'id' => 'password', 'required')) !!}

              </div>

              <div class="form-group-separator"></div>

              <div class="form-group">
                {!! Form::label('roles', 'Assign Role(s)', array('class' => 'control-label', 'for' => 'assign_permission')) !!}

                {!! Form::select('assign_roles[]', $roles, null, array('class' => 'form-control', 'id' => 'assign_roles', 'multiple' => 'multiple', 'required')) !!}
              </div>

              <div class="form-group-separator"></div>

              <div class="form-group">
                {!! Form::label('assign_permission', ' ', array('class' => 'control-label', 'for' => 'assign_permission')) !!}

                {!! Form::submit('Add User', array('class' => 'btn btn-primary', 'id' => 'add-user')) !!}

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

