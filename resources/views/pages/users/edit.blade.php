
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal ajaxForm', 'role' => 'form']) !!}

    <div class="form-group">
      {!! Form::label('member_id', 'Member', array('class' => 'control-label', 'for' => 'member_id')) !!}

      {!! Form::select('member_id', $members, null, ['class' => 'form-control select', 'placeholder' => 'Select one', 'id' => 'member_id', 'required', 'disabled', 'style' => 'width:100%']) !!}
      
      {!! Form::hidden('member_id', $user->id) !!}

    </div>

    <div class="form-group-separator"></div>

    <div class="form-group">
      {!! Form::label('password', 'Password', array('class' => 'control-label', 'for' => 'member_id')) !!}

      {!! Form::password('password', null, ['class' => 'form-control', 'id' => 'password', 'style' => 'width:100%']) !!}
      
    </div>

    <div class="form-group-separator"></div>

    <div class="form-group">
      {!! Form::label('roles', 'Assign Role(s)', array('class' => 'control-label', 'for' => 'assign_permission')) !!}

      {!! Form::select('assign_roles[]', $roles, null, array('class' => 'form-control', 'id' => 'assign_roles', 'multiple' => 'multiple', 'required')) !!}
    </div>

    <div class="form-group-separator"></div>

    <div class="form-group">
      {!! Form::label('assign_permission', ' ', array('class' => 'control-label', 'for' => 'assign_permission')) !!}

      {!! Form::submit('Update User', array('class' => 'btn btn-primary', 'id' => 'add-user')) !!}

    </div>

    {!! Form::close() !!}