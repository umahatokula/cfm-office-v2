
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
        <div class="row">
          <div class="col-xs-12" id="errorMsg">
          </div>
        </div>

          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          {!! Form::open(['route' => 'members.store', 'method' => 'POST', 'class' => 'form-horizontal ajaxForm', 'role' => 'form', 'files' => true]) !!}

          <div class="form-group">
            {!! Form::label('fname', 'First Name', array('class' => 'col-sm-4 control-label', 'for' => 'fname')) !!}

            <div class="col-sm-8">
              {!! Form::text('fname', null, array('class' => 'form-control', 'id' => 'fname')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('lname', 'Last Name', array('class' => 'col-sm-4 control-label', 'for' => 'lname')) !!}

            <div class="col-sm-8">
              {!! Form::text('lname', null, array('class' => 'form-control', 'id' => 'lname')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('mname', 'Middle Name', array('class' => 'col-sm-4 control-label', 'for' => 'mname')) !!}

            <div class="col-sm-8">
              {!! Form::text('mname', null, array('class' => 'form-control', 'id' => 'mname')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('gender_id', 'Gender', array('class' => 'col-sm-4 control-label', 'for' => 'gender_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('gender_id', $gender, null, array('class' => 'form-control', 'id' => 'gender_id', 'placeholder' => 'Select one')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('email', 'Email', array('class' => 'col-sm-4 control-label', 'for' => 'email')) !!}

            <div class="col-sm-8">
              {!! Form::email('email', null, array('class' => 'form-control', 'id' => 'email')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label', 'for' => 'phone')) !!}

            <div class="col-sm-8">
              {!! Form::text('phone', null, array('class' => 'form-control', 'id' => 'phone')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('occupation', 'Occupation', array('class' => 'col-sm-4 control-label', 'for' => 'occupation')) !!}

            <div class="col-sm-8">
              {!! Form::text('occupation', null, array('class' => 'form-control', 'id' => 'occupation')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('country_id', 'Country', array('class' => 'col-sm-4 control-label', 'for' => 'country_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('country_id', $countries, null, array('class' => 'form-control select', 'id' => 'country_id', 'placeholder' => 'Select one')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('state_id', 'State of origin', array('class' => 'col-sm-4 control-label', 'for' => 'state_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('state_id', $states, null, array('class' => 'form-control select', 'id' => 'state_id', 'placeholder' => 'Select one')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('local_id', 'Local', array('class' => 'col-sm-4 control-label', 'for' => 'local_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('local_id', $locals, null, array('class' => 'form-control select', 'id' => 'local_id', 'placeholder' => 'Select one')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('dob', 'Date of Birth', array('class' => 'col-sm-4 control-label', 'for' => 'dob')) !!}

            <div class="col-sm-8">
              {{-- {!! Form::date('dob', null, ['class' => 'form-control date', 'placeholder' => 'Date']) !!} --}}
              {!! Form::select('day', $days, null, array('class' => 'form-control select', 'id' => 'local_id', 'placeholder' => 'Select day')) !!}
              {!! Form::select('month', $months, null, array('class' => 'form-control select', 'id' => 'local_id', 'placeholder' => 'Select month')) !!}
              {!! Form::text('year', null, ['class' => 'form-control', 'placeholder' => 'Enter Year']) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('age_profile_id', 'Age Profile', array('class' => 'col-sm-4 control-label', 'for' => 'age_profile_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('age_profile_id', $ageProfiles, null, array('class' => 'form-control', 'id' => 'age_profile_id', 'placeholder' => 'Select one')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('church_id', 'Church', array('class' => 'col-sm-4 control-label', 'for' => 'church_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('church_id', $churches, Auth::user()->member->church_id, array('class' => 'form-control', 'id' => 'church_id', 'placeholder' => 'Select one', 'disabled')) !!}

              {!! Form::hidden('church_id', Auth::user()->member->church_id) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('address', 'Address', array('class' => 'col-sm-4 control-label', 'for' => 'address')) !!}

            <div class="col-sm-8">
              {!! Form::textarea('address', null, array('class' => 'form-control', 'id' => 'address')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('region_id', 'Region', array('class' => 'col-sm-4 control-label', 'for' => 'region_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('region_id', $regions, Auth::user()->member->region_id, array('class' => 'form-control', 'id' => 'region_id', 'placeholder' => 'Select one')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('picture', 'Upload picture', array('class' => 'col-sm-4 control-label', 'for' => 'picture')) !!}

            <div class="col-sm-8">
              {!! Form::file('picture', array('class' => 'form-control', 'id' => 'picture')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('cell_id', 'Cell', array('class' => 'col-sm-4 control-label', 'for' => 'cell_id')) !!}

            <div class="col-sm-8">
              {!! Form::select('cell_id', $cells, null, array('class' => 'form-control', 'id' => 'cell_id', 'placeholder' => 'Select one')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('facebook', 'Facebook', array('class' => 'col-sm-4 control-label', 'for' => 'facebook')) !!}

            <div class="col-sm-8">
              {!! Form::text('facebook', null, array('class' => 'form-control', 'id' => 'facebook')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('whatsapp', 'Whatsapp', array('class' => 'col-sm-4 control-label', 'for' => 'whatsapp')) !!}

            <div class="col-sm-8">
              {!! Form::text('whatsapp', null, array('class' => 'form-control', 'id' => 'whatsapp')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('twitter', 'Twitter', array('class' => 'col-sm-4 control-label', 'for' => 'twitter')) !!}

            <div class="col-sm-8">
              {!! Form::text('twitter', null, array('class' => 'form-control', 'id' => 'twitter')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('instagram', 'Instagram', array('class' => 'col-sm-4 control-label', 'for' => 'instagram')) !!}

            <div class="col-sm-8">
              {!! Form::text('instagram', null, array('class' => 'form-control', 'id' => 'instagram')) !!}
            </div>
          </div>

          <div class="form-group-separator"></div>

          <div class="form-group">
            {!! Form::label('address', ' ', array('class' => 'col-sm-4 control-label', 'for' => 'address')) !!}

            <div class="col-sm-8">
              {!! Form::submit('Add', array('class' => 'btn btn-primary btn-sm')) !!}
            </div>
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {

//SUBMIT FORM VIA AJAX
$('.ajaxForm').ajaxForm(function(response) {
  console.log(response.message);
  if (response.success) {

    $.notify({
      title: "Attention : ",
      message: response.message,
      icon: 'fa fa-check' 
    },{
      type: "info"
    });

    window.location.replace("{{ route('members.index') }}");
  }

  if (!response.success) {
    // console.log(response.message);
    var error = "<ul class='bg-danger text-danger'>";
    $.each(response.message, function(key, value) {
     error += "<li>"+value+"</li>"
   })
    error += "</ul>";
    $('#errorMsg').html(error)

  }

}); 


}); 
</script>

