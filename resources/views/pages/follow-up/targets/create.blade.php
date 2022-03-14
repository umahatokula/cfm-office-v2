
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

                            
                                <div class="row mb-3">
                                    <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('fname', null, ['class' => 'form-control', 'id' => 'fname']) !!}
                                        @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="lname" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('lname', null, ['class' => 'form-control', 'id' => 'lname']) !!}
                                        @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) !!}
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">Residential Address</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address']) !!}
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="marital_status_id" class="col-sm-2 col-form-label">Marital Status</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('marital_status_id', $ageProfiles, null, ['class' => 'form-control', 'id' => 'marital_status_id', 'placeholder' => 'Select one']) !!}
                                        @error('marital_status_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="age_profile_id" class="col-sm-2 col-form-label">Age Profile</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('age_profile_id', $ageProfiles, null, ['class' => 'form-control', 'id' => 'age_profile_id', 'placeholder' => 'Select one']) !!}
                                        @error('age_profile_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="who_invited_you" class="col-sm-2 col-form-label">Who Invited you?</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('who_invited_you', null, ['class' => 'form-control', 'id' => 'who_invited_you']) !!}
                                        @error('who_invited_you') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">How did you hear about CFC?</legend>
                                    <div class="col-sm-10">
                                        @forelse ($ftgInvitationModes as $ftgInvitationMode)
                                        <div class="form-check">
                                            <input name="ftgInvitationModes[]" value="{{ $ftgInvitationMode->id }}" class="form-check-input" type="checkbox" id="{{ $ftgInvitationMode->id }}">
                                            <label class="form-check-label" for="{{ $ftgInvitationMode->id }}">
                                                {{ $ftgInvitationMode->name }}
                                            </label>
                                        </div>
                                        @empty
                                            <p>No data</p>
                                        @endforelse
                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Are you interested in joining CFC?</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input name="want_to_become_a_member" value="1" class="form-check-input" type="radio" id="inte_yes" value="option1" checked>
                                            <label class="form-check-label" for="inte_yes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="want_to_become_a_member" value="0" class="form-check-input" type="radio" id="inte_no" value="option1" checked>
                                            <label class="form-check-label" for="inte_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Would you appreciate a visit?</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input name="appreciate_a_visit" value="1" class="form-check-input" type="radio" id="inte_yes" value="option1" checked>
                                            <label class="form-check-label" for="inte_yes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="appreciate_a_visit" value="0" class="form-check-input" type="radio" id="inte_no" value="option1" checked>
                                            <label class="form-check-label" for="inte_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            
                                <div class="row mb-3">
                                    <label for="day_of_week_for_visit" class="col-sm-2 col-form-label">What day of the week?</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('day_of_week_for_visit', null, ['class' => 'form-control', 'id' => 'day_of_week_for_visit']) !!}
                                        @error('day_of_week_for_visit') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Would you appreciate a call?</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input name="appreciate_a_call" value="1" class="form-check-input" type="radio" id="inte_yes" value="option1" checked>
                                            <label class="form-check-label" for="inte_yes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="appreciate_a_call" value="0" class="form-check-input" type="radio" id="inte_no" value="option1" checked>
                                            <label class="form-check-label" for="inte_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            
                                <div class="row mb-3">
                                    <label for="day_of_week_for_call" class="col-sm-2 col-form-label">What day of the week?</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('day_of_week_for_call', null, ['class' => 'form-control', 'id' => 'day_of_week_for_call']) !!}
                                        @error('day_of_week_for_call') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <p><b>Do you want us to pray for you?</b></p>
                            
                                <div class="row mb-3">
                                    <label for="prayer_request" class="col-sm-2 col-form-label">Request</label>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('prayer_request', null, ['class' => 'form-control', 'id' => 'prayer_request', 'placeholder' => 'Notes...']) !!}
                                        @error('prayer_request') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">I am interested in</legend>
                                    <div class="col-sm-10">
                                        @forelse ($fTGInterests as $fTGInterest)
                                        <div class="form-check">
                                            <input name="fTGInterests[]" value="{{ $fTGInterest->id }}" class="form-check-input" type="checkbox" id="{{ $fTGInterest->id }}">
                                            <label class="form-check-label" for="{{ $fTGInterest->id }}">
                                                {{ $fTGInterest->name }}
                                            </label>
                                        </div>
                                        @empty
                                            <p>No data</p>
                                        @endforelse
                                    </div>
                                </fieldset>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">I would like more information about</legend>
                                    <div class="col-sm-10">
                                        @forelse ($fTGInformationNeeds as $fTGInformationNeed)
                                        <div class="form-check">
                                            <input name="fTGInformationNeeds[]" value="{{ $fTGInformationNeed->id }}" class="form-check-input" type="checkbox" id="{{ $fTGInformationNeed->id }}">
                                            <label class="form-check-label" for="{{ $fTGInformationNeed->id }}">
                                                {{ $fTGInformationNeed->name }}
                                            </label>
                                        </div>
                                        @empty
                                            <p>No data</p>
                                        @endforelse
                                    </div>
                                </fieldset>
                            
                                <div class="row mb-3">
                                    <label for="church_id" class="col-sm-2 col-form-label">Church</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('church_id', $churches, auth()->user()->church ? auth()->user()->church->id : null, ['class' => 'form-control', 'id' => 'church_id', 'placeholder' => 'Select one']) !!}
                                        @error('church_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('notes', null, ['class' => 'form-control', 'id' => 'notes', 'placeholder' => 'Notes...']) !!}
                                        @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
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
