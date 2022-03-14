
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


    <div class="form-group mb-3 mb-md-4">
        {{ Form::label('member_id', 'Member', array('class' => 'control-label', 'for' => 'member_id'))
        }}

        {{ Form::select('member_id', $members->pluck('name', 'id'), null, ['class' => 'form-control select', 'placeholder'
        => 'Select one', 'id' => 'member_id', 'required', 'style' => 'width:100%']) }}

    </div>

    <div class="form-group mb-3 mb-md-4">
        {{ Form::label('phone', 'Phone number', array('class' => 'control-label', 'for' => 'phone'))
        }}

        {{ Form::number('phone', null, array('class' => 'form-control', 'id' => 'phone', 'required'))
        }}

    </div>

    <div class="form-group mb-3 mb-md-4">
        {{ Form::label('password', 'Password', array('class' => 'control-label', 'for' => 'password'))
        }}

        {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'required'))
        }}

    </div>

    <div class="form-group mb-3 mb-md-4">
        {{ Form::label('roles', 'Assign Role(s)', array('class' => 'control-label', 'for' =>
        'assign_permission')) }}

        {{ Form::select('assign_roles[]', $roles, null, array('class' => 'form-control', 'id' =>
        'assign_roles', 'multiple' => 'multiple', 'required')) }}
    </div>

    <div class="form-group">
        {{ Form::label('assign_permission', ' ', array('class' => 'control-label', 'for' =>
        'assign_permission')) }}

        {{ Form::submit('Save Changes', array('class' => 'btn btn-primary', 'id' => 'add-user')) }}

    </div>

    {{ Form::close() }}