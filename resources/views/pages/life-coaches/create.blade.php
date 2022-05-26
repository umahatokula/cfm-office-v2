@extends('layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Create New Coach</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">&nbsp</h5>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" method="POST" action=" {{ route('life-coaches.store') }} ">

                                @csrf

                                <p>Required fields <span class="text-danger">*</span></p>

                                <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">First Name</label>
                                    {!! Form::text('fname', null, ['class' => 'form-control', 'id' => 'fname']) !!}
                                    @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="lname" class="form-label">Last Name</label>
                                    {!! Form::text('lname', null, ['class' => 'form-control', 'id' => 'lname']) !!}
                                    @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) !!}
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="gender_id" class="form-label">Gender <span class="text-danger">*</span></label>
                                    {!! Form::select('gender_id', $genders->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'gender_id', 'placeholder' => 'Select one']) !!}
                                    @error('gender_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="marital_status_id" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                    {!! Form::select('marital_status_id', $maritalStatuses->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'marital_status_id', 'placeholder' => 'Select one']) !!}
                                    @error('marital_status_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="cell_id" class="form-label">Home Cell</label>
                                    {!! Form::select('cell_id', $cells->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'cell_id', 'placeholder' => 'Select one']) !!}
                                    @error('cell_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="c3_id" class="form-label">Cell Church Colony</label>
                                    {!! Form::select('c3_id', $c3s->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'c3_id', 'placeholder' => 'Select one']) !!}
                                    @error('c3_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="service_team_id" class="form-label">Service Team</label>
                                    {!! Form::select('service_team_id', $serviceTeams->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'service_team_id', 'placeholder' => 'Select one']) !!}
                                    @error('service_team_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    {!! Form::text('occupation', null, ['class' => 'form-control', 'id' => 'occupation', 'placeholder' => '']) !!}
                                    @error('occupation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="residential_address" class="form-label">Residential Address</label>
                                    {!! Form::text('residential_address', null, ['class' => 'form-control', 'id' => 'residential_address', 'placeholder' => '']) !!}
                                    @error('residential_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="church_id" class="form-label">Campus</label>
                                    {!! Form::select('church_id', $churches->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'church_id', 'placeholder' => 'Select one']) !!}
                                    @error('church_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12">
                                    <a class="btn btn-warning me-1" href="{{ url()->previous() }}">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
