
@extends('layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Create Target</h1>
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
                            
                            {!! Form::open(['route' => 'followup-targets.store', 'class' => 'row g-3']) !!}

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
                                    <label for="Email" class="form-label">Email</label>
                                    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) !!}
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="church_id" class="form-label">Church</label>
                                    {!! Form::select('church_id', $churches, null, ['class' => 'form-control', 'id' => 'church_id', 'placeholder' => 'Select one']) !!}
                                    @error('church_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="age_profile_id" class="form-label">Age Profile</label>
                                    {!! Form::select('age_profile_id', $ageProfiles, null, ['class' => 'form-control', 'id' => 'age_profile_id', 'placeholder' => 'Select one']) !!}
                                    @error('age_profile_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="notes" class="form-label">Notes</label>
                                    {!! Form::textarea('notes', null, ['class' => 'form-control', 'id' => 'notes', 'placeholder' => 'Notes...']) !!}
                                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
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
