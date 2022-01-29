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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">&nbsp</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
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
                        {!! Form::open( array('route' => 'church-services.store', 'class' => 'ajaxForm', 'role' =>
                        'form', 'id'
                        => 'churchServiceForm')) !!}
                        <div class="row mb-5">
                            <div class="col-12">
                                <h5>Service Information</h5>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('service_type_id', 'Service Type', array('class' => 'control-label',
                                'for' =>
                                'service_type_id')) !!}

                                {!! Form::select('service_type_id', $service_types, null, array('class' =>
                                'form-control', 'id'
                                => 'service_type_id', 'placeholder' => 'Select service type', 'required')) !!}
                            </div>


                            <div class="col-md-4">
                                {!! Form::label('service_date', 'Service Date', array('class' => 'control-label', 'for'
                                =>
                                'service_date')) !!}

                                {!! Form::date('service_date', null, array('class' => 'form-control', 'id' =>
                                'service_date',
                                'required')) !!}
                            </div>

                            <div class="col-sm-12" id="special_service_row" style="display: none">
                                {!! Form::label('special_service', 'Special Service (Specify)', array('class' =>
                                'control-label', 'for' => 'special_service')) !!}

                                {!! Form::text('special_service', null, array('class' => 'form-control', 'id' =>
                                'special_service')) !!}
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h5>Attendance</h5>
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('attendance_men', 'Men', array('class' => ' control-label', 'for' =>
                                'attendance_men')) !!}

                                {!! Form::input('number','attendance_men', 0, array('class' => 'form-control', 'id' =>
                                'attendance_men')) !!}

                            </div>
                            <div class="col-md-4">
                                {!! Form::label('attendance_women', 'Women', array('class' => ' control-label', 'for' =>
                                'attendance_women')) !!}

                                {!! Form::input('number','attendance_women', 0, array('class' => 'form-control', 'id' =>
                                'attendance_women')) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('attendance_children', 'Children', array('class' => ' control-label',
                                'for' => 'attendance_children')) !!}

                                {!! Form::input('number','attendance_children', 0, array('class' => 'form-control', 'id'
                                => 'attendance_children')) !!}
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h5>First Time Guests</h5>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('first_timers_men', 'Men', array('class' => 'control-label', 'for' =>
                                'first_timers_men')) !!}

                                {!! Form::input('number','first_timers_men', 0, array('class' => 'form-control', 'id' =>
                                'first_timers_men')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('first_timers_women', 'Women', array('class' => 'control-label', 'for'
                                => 'first_timers_women')) !!}

                                {!! Form::input('number','first_timers_women', 0, array('class' => 'form-control', 'id'
                                => 'first_timers_women')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('first_timers_children', 'Children', array('class' => 'control-label',
                                'for' => 'first_timers_children')) !!}

                                {!! Form::input('number','first_timers_children', 0, array('class' => 'form-control',
                                'id' => 'first_timers_children')) !!}
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h5>Born Again</h5>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('born_again_men', 'Men', array('class' => 'control-label', 'for' =>
                                'born_again_men')) !!}

                                {!! Form::input('number','born_again_men', 0, array('class' => 'form-control', 'id' =>
                                'born_again_men')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('born_again_women', 'Women', array('class' => 'control-label', 'for' =>
                                'born_again_women')) !!}

                                {!! Form::input('number','born_again_women', 0, array('class' => 'form-control', 'id' =>
                                'born_again_women')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('born_again_children', 'Children', array('class' => 'control-label',
                                'for' => 'born_again_children')) !!}

                                {!! Form::input('number','born_again_children', 0, array('class' => 'form-control', 'id'
                                => 'born_again_children')) !!}
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-12">
                                <h5>Holy Ghost Filled</h5>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('filled_men', 'Men', array('class' => 'control-label', 'for' =>
                                'filled_men')) !!}

                                {!! Form::input('number','filled_men', 0, array('class' => 'form-control', 'id' =>
                                'filled_men')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('filled_women', 'Women', array('class' => 'control-label', 'for' =>
                                'filled_women')) !!}

                                {!! Form::input('number','filled_women', 0, array('class' => 'form-control', 'id' =>
                                'filled_women')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('filled_children', 'Children', array('class' => 'control-label', 'for'
                                => 'filled_children')) !!}

                                {!! Form::input('number','filled_children', 0, array('class' => 'form-control', 'id' =>
                                'filled_children')) !!}
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12">
                                <h5>Offerings</h5>
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('regular_offering', 'Regular', array('class' => 'control-label', 'for'
                                => 'regular_offering')) !!}

                                {!! Form::input('number','regular_offering', 0, array('class' => 'form-control', 'id' =>
                                'regular_offering')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('tithes', 'Tithes', array('class' => 'control-label', 'for' =>
                                'tithes')) !!}

                                {!! Form::input('number','tithes', 0, array('class' => 'form-control', 'id' =>
                                'tithes')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('connection', 'Connection', array('class' => 'control-label', 'for' =>
                                'connection')) !!}

                                {!! Form::input('number','connection', 0, array('class' => 'form-control', 'id' =>
                                'connection')) !!}
                            </div>


                            <div class="col-md-4">
                                {!! Form::label('first_fruit', 'First Fruit', array('class' => 'control-label', 'for' =>
                                'first_fruit')) !!}

                                {!! Form::input('number','first_fruit', 0, array('class' => 'form-control', 'id' =>
                                'first_fruit')) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('thanksgiving_offering', 'Thanksgiving', array('class' => '
                                control-label', 'for' => 'thanksgiving_offering')) !!}

                                {!! Form::input('number','thanksgiving_offering', 0, array('class' => 'form-control',
                                'id' => 'thanksgiving_offering')) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('special_offering', 'Special', array('class' => 'control-label', 'for'
                                => 'special_offering')) !!}

                                {!! Form::input('number','special_offering', 0, array('class' => 'form-control', 'id' =>
                                'special_offering')) !!}
                            </div>


                            <div class="col-md-4">
                                {!! Form::label('project_offering', 'Project', array('class' => 'control-label', 'for'
                                => 'project_offering')) !!}

                                {!! Form::input('number','project_offering', 0, array('class' => 'form-control', 'id' =>
                                'project_offering')) !!}
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('pos', 'POS', array('class' => 'control-label', 'for' => 'pos')) !!}

                                {!! Form::input('number','pos', 0, array('class' => 'form-control', 'id' => 'pos')) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('honourarium', 'Honourarium', array('class' => 'control-label', 'for' =>
                                'honourarium')) !!}

                                {!! Form::input('number','honourarium', 0, array('class' => 'form-control', 'id' =>
                                'honourarium')) !!}
                            </div>



                            <div class="col-md-4">
                                {!! Form::label('others', 'Others', array('class' => 'control-label', 'for' =>
                                'others')) !!}

                                {!! Form::input('number','others', 0, array('class' => 'form-control', 'id' =>
                                'others')) !!}
                            </div>

                        </div>
                        </fieldset>
                    </div>

                    <hr>

                    <div class="form-group">

                        <div class="col-sm-12 text-center">
                            {!! Form::submit('Save service information', array('class' => 'btn btn-primary')) !!}
                            <a href="{{ route('church-services.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">
    $(document).ready(function () {

        $('select[name=service_type_id]').change(function () {
            var selected = $('#service_type_id option:selected').text();

            if (selected == "Special Service") {
                $('#special_service_row').show();
            } else {

                $('#special_service_row').hide();
            }
        })

        //SUBMIT FORM VIA AJAX
        $('.ajaxForm').ajaxForm(function (response) {
            // console.log(response.message);

            if (response.success) {

                $.notify({
                    title: "Attention : ",
                    message: response.message,
                    icon: 'fa fa-check'
                }, {
                    type: "info"
                });

                $('#myModal').modal('toggle');
            }

            if (!response.success) {
                // console.log(response.message);
                var error = "<ul class='bg-danger text-danger'>";
                $.each(response.message, function (key, value) {
                    error += "<li>" + value + "</li>"
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
@endpush
