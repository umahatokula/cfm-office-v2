<div class="row">
    <div class="col-12 mb-5">

        <div class="alert alert-custom" role="alert">
            <div class="custom-alert-icon icon-primary"><i class="material-icons-outlined">done</i></div>
            <div class="alert-content">
                <span class="alert-text">This target will be assigned to <b>{{ $coach->name }}</span>
            </div>
        </div>

    </div>
    <div class="col-12">

        {!! Form::open(['route' => 'life-coaches.create-target.store', 'class' => 'row g-3']) !!}
        @csrf

        <input type="hidden" name="assign_immediately" value="1" />
        <input type="hidden" name="coach_id" value="{{ $coach->id }}" />

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
