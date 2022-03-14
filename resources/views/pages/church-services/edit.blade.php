
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
        {!! Form::model($churchService, ['route' => ['church-services.update', $churchService->id], 'method' => 'PUT', 'class' => 'form-horizontal ajaxForm', 'role' => 'form']) !!}
        <div class="row">
          <fieldset>
            <h4><span class="text-primary" style="font-size: 20px;">Service Information</span></h4>

            <div class="col-sm-6">
              {!! Form::label('service_type_id', 'Service Type', array('class' => 'control-label', 'for' => 'service_type_id')) !!}

              {!! Form::select('service_type_id', $service_types, null, array('class' => 'form-control', 'id' => 'service_type_id', 'placeholder' => 'Select service type', 'required')) !!}
            </div>


            <div class="col-sm-6">
              {!! Form::label('service_date', 'Service Date', array('class' => 'control-label', 'for' => 'service_date')) !!}

              {!! Form::text('service_date', null, array('class' => 'form-control date', 'id' => 'service_date', 'required')) !!}
            </div>

            <div class="col-sm-12" id="special_service_row" style="display: {{$churchService->service_type_id == 6 ? '' : 'none'}};">
              {!! Form::label('special_service', 'Special Service (Specify)', array('class' => 'control-label', 'for' => 'special_service')) !!}

              {!! Form::text('special_service', null, array('class' => 'form-control', 'id' => 'special_service')) !!}
            </div>

          </fieldset>
        </div>

        <hr>

        <div class="row">
          <fieldset>
            <h4><span class="text-primary" style="font-size: 20px;">Attendance</span></h4>
            <div class="form-group">
              <div class="col-md-4">
                {!! Form::label('attendance_men', 'Men', array('class' => ' control-label', 'for' => 'attendance_men')) !!}

                {!! Form::input('number','attendance_men', null, array('class' => 'form-control', 'id' => 'attendance_men')) !!}

              </div>
              <div class="col-md-4">
                {!! Form::label('attendance_women', 'Women', array('class' => ' control-label', 'for' => 'attendance_women')) !!}

                {!! Form::input('number','attendance_women', null, array('class' => 'form-control', 'id' => 'attendance_women')) !!}
              </div>
              <div class="col-md-4">
                {!! Form::label('attendance_children', 'Children', array('class' => ' control-label', 'for' => 'attendance_children')) !!}

                {!! Form::input('number','attendance_children', null, array('class' => 'form-control', 'id' => 'attendance_children')) !!}
              </div>
            </div>
          </fieldset>
        </div>

        <hr>

        <div class="row">
          <fieldset>
            <h4><span class="text-primary" style="font-size: 20px;">First Time Guests</span></h4>
            <div class="form-group">

              <div class="col-md-4">
                {!! Form::label('first_timers_men', 'Men', array('class' => 'control-label', 'for' => 'first_timers_men')) !!}

                {!! Form::input('number','first_timers_men', null, array('class' => 'form-control', 'id' => 'first_timers_men')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('first_timers_women', 'Women', array('class' => 'control-label', 'for' => 'first_timers_women')) !!}

                {!! Form::input('number','first_timers_women', null, array('class' => 'form-control', 'id' => 'first_timers_women')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('first_timers_children', 'Children', array('class' => 'control-label', 'for' => 'first_timers_children')) !!}

                {!! Form::input('number','first_timers_children', null, array('class' => 'form-control', 'id' => 'first_timers_children')) !!}
              </div>

            </div>
          </fieldset>
        </div>

        <hr>

        <div class="row">
          <fieldset>
            <h4><span class="text-primary" style="font-size: 20px;">Born Again</span></h4>
            <div class="form-group">

              <div class="col-md-4">
                {!! Form::label('born_again_men', 'Men', array('class' => 'control-label', 'for' => 'born_again_men')) !!}

                {!! Form::input('number','born_again_men', null, array('class' => 'form-control', 'id' => 'born_again_men')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('born_again_women', 'Women', array('class' => 'control-label', 'for' => 'born_again_women')) !!}

                {!! Form::input('number','born_again_women', null, array('class' => 'form-control', 'id' => 'born_again_women')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('born_again_children', 'Children', array('class' => 'control-label', 'for' => 'born_again_children')) !!}

                {!! Form::input('number','born_again_children', null, array('class' => 'form-control', 'id' => 'born_again_children')) !!}
              </div>

            </div>
          </fieldset>
        </div>

        <hr>

        <div class="row">
          <fieldset>
            <h4><span class="text-primary" style="font-size: 20px;">Holy Ghost Filled</span></h4>
            <div class="form-group">

              <div class="col-md-4">
                {!! Form::label('filled_men', 'Men', array('class' => 'control-label', 'for' => 'filled_men')) !!}

                {!! Form::input('number','filled_men', null, array('class' => 'form-control', 'id' => 'filled_men')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('filled_women', 'Women', array('class' => 'control-label', 'for' => 'filled_women')) !!}

                {!! Form::input('number','filled_women', null, array('class' => 'form-control', 'id' => 'filled_women')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('filled_children', 'Children', array('class' => 'control-label', 'for' => 'filled_children')) !!}

                {!! Form::input('number','filled_children', null, array('class' => 'form-control', 'id' => 'filled_children')) !!}
              </div>

            </div>
          </fieldset>
        </div>

        <h4></h4>

        <div class="row">
          <fieldset>
            <h4><span class="text-primary" style="font-size: 20px;">Offerings</span></h4>

            <div class="form-group">
              <div class="col-md-4">
                {!! Form::label('regular_offering', 'Regular', array('class' => 'control-label', 'for' => 'regular_offering')) !!}

                {!! Form::input('number','regular_offering', null, array('class' => 'form-control', 'id' => 'regular_offering')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('tithes', 'Tithes', array('class' => 'control-label', 'for' => 'tithes')) !!}

                {!! Form::input('number','tithes', null, array('class' => 'form-control', 'id' => 'tithes')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('connection', 'Connection', array('class' => 'control-label', 'for' => 'connection')) !!}

                {!! Form::input('number','connection', null, array('class' => 'form-control', 'id' => 'connection')) !!}
              </div>

            </div>

            <div class="form-group-separator"></div>

            <div class="form-group">

              <div class="col-md-4">
                {!! Form::label('first_fruit', 'First Fruit', array('class' => 'control-label', 'for' => 'first_fruit')) !!}

                {!! Form::input('number','first_fruit', null, array('class' => 'form-control', 'id' => 'first_fruit')) !!}
              </div>
              <div class="col-md-4">
                {!! Form::label('thanksgiving_offering', 'Thanksgiving', array('class' => ' control-label', 'for' => 'thanksgiving_offering')) !!}

                {!! Form::input('number','thanksgiving_offering', null, array('class' => 'form-control', 'id' => 'thanksgiving_offering')) !!}
              </div>
              <div class="col-md-4">
                {!! Form::label('special_offering', 'Special', array('class' => 'control-label', 'for' => 'special_offering')) !!}

                {!! Form::input('number','special_offering', null, array('class' => 'form-control', 'id' => 'special_offering')) !!}
              </div>

            </div>

            <div class="form-group-separator"></div>

            <div class="form-group">

              <div class="col-md-4">
                {!! Form::label('project_offering', 'Project', array('class' => 'control-label', 'for' => 'project_offering')) !!}

                {!! Form::input('number','project_offering', null, array('class' => 'form-control', 'id' => 'project_offering')) !!}
              </div>

              <div class="col-md-4">
                {!! Form::label('pos', 'POS', array('class' => 'control-label', 'for' => 'pos')) !!}

                {!! Form::input('number','pos', null, array('class' => 'form-control', 'id' => 'pos')) !!}
              </div>
              <div class="col-md-4">
                {!! Form::label('honourarium', 'Honourarium', array('class' => 'control-label', 'for' => 'honourarium')) !!}

                {!! Form::input('number','honourarium', null, array('class' => 'form-control', 'id' => 'honourarium')) !!}
              </div>

            </div>

            <div class="form-group-separator"></div>

            <div class="form-group">


              <div class="col-md-4">
                {!! Form::label('others', 'Others', array('class' => 'control-label', 'for' => 'others')) !!}

                {!! Form::input('number','others', null, array('class' => 'form-control', 'id' => 'others')) !!}
              </div>

            </div>
          </fieldset>
        </div>

        <hr>

        <div class="form-group">

          <div class="col-sm-12 text-center">
            {!! Form::submit('Save service information', array('class' => 'btn btn-xs btn-info')) !!}
          </div>
        </div>

        <!-- </form> -->
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

    $('select[name=service_type_id]').change(function() {
      var selected = $('#service_type_id option:selected').text();

      if(selected == "Special Service") {
        $('#special_service_row').show();
      } else {

        $('#special_service_row').hide();
      }
    })

//SUBMIT FORM VIA AJAX
$('.ajaxForm').ajaxForm(function(response) {
  // console.log(response.message);

  if (response.success) {

    $.notify({
      title: "Attention : ",
      message: response.message,
      icon: 'fa fa-check' 
    },{
      type: "info"
    });

    $('#myModal').modal('toggle');
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


    // date plugin
    $('.date').datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
      todayHighlight: true
    });

  }); 
</script>