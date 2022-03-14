@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Life Coaches</h1>
                <span>List of all Life Coaches</span>
            </div>
            <div class="page-description-actions">
                <a href="#" class="btn btn-dark"><i class="material-icons-outlined">file_download</i>Download</a>
                <a href="#" class="btn btn-primary"><i class="material-icons">add</i>Create</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">&nbsp</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
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
                          @forelse ($users as $user)
                            <tr id="tr_{{$user->id}}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ ($user->member->name) }}
                                </td>
                                <td>
                                    @foreach($user->roles as $role)
                                    {{ $role->name }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @if($user->member->church)
                                    {{ $user->member->church->name }}
                                    @endif
                                </td>
                                <td class="text-center">                                    
                                    <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('users.edit', array($user->id)) }}" data-bs-toggle="modal" data-bs-target="#modal-large" backdrop="static" href="#" class="text-primary p-0" title="Report">
                                        <span class="material-icons-sharp">edit</span>
                                    </a>
                                    <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('users.delete', array($user->id)) }}" href="#" class="text-danger p-0" data-bs-toggle="modal" data-bs-target="#modal-large" title="Delete">
                                        <span class="material-icons-sharp">delete</span>
                                    </a>
                                    <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('users.show', $user->id) }}" href="{{ route('users.show', $user->id) }}" class="text-dark p-0" data-bs-toggle="modal" data-bs-target="#modal-large" title="More Actions">
                                        <span class="material-icons-sharp">remove_red_eye</span>
                                    </a>
                                </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="5">No users</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">&nbsp</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">


                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{ Form::open(array('route' => 'users.store', 'class' => '', 'role' => 'form')) }}

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

                        {{ Form::submit('Add User', array('class' => 'btn btn-primary', 'id' => 'add-user')) }}

                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
