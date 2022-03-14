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

                        {!! Form::open(['route' => 'churches.store', 'method' => 'POST', 'class' => 'form-horizontal
                        ajaxForm', 'role' => 'form', 'files' => true]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name', array('class' => 'col-lg-4 control-label', 'for' => 'name'))
                            !!}

                            <div class="col-lg-8">
                                {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            {!! Form::label('phone', 'Phone', array('class' => 'col-lg-4 control-label', 'for' =>
                            'phone')) !!}

                            <div class="col-lg-8">
                                {!! Form::text('phone', null, array('class' => 'form-control', 'id' => 'phone')) !!}
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email', array('class' => 'col-lg-4 control-label', 'for' =>
                            'email')) !!}

                            <div class="col-lg-8">
                                {!! Form::email('email', null, array('class' => 'form-control', 'id' => 'email')) !!}
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            {!! Form::label('resident_pastor', 'Resident Pastor', array('class' => 'col-lg-4
                            control-label', 'for' => 'resident_pastor')) !!}

                            <div class="col-lg-8">
                                {!! Form::select('resident_pastor', $members, null, array('class' => 'form-control
                                select', 'id' => 'resident_pastor', 'placeholder' => 'Select one')) !!}
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            {!! Form::label('associate_pastors', 'Associate Pastor(s)', array('class' => 'col-lg-4
                            control-label', 'for' => 'associate_pastors')) !!}

                            <div class="col-lg-8">
                                {!! Form::select('associate_pastors[]', $members, null, array('class' => 'form-control
                                select', 'id' => 'associate_pastors', 'multiple')) !!}
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            {!! Form::label('address', 'Address', array('class' => 'col-lg-4 control-label', 'for' =>
                            'address')) !!}

                            <div class="col-lg-8">
                                {!! Form::textarea('address', null, ['class' => 'form-control date', 'rows' => 5]) !!}
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">

                            <div class="col-lg-8 text-center">
                                {!! Form::submit('Add church', array('class' => 'btn btn-info btn-xs')) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {

                //SUBMIT FORM VIA AJAX
                $('.ajaxForm').ajaxForm(function (response) {
                    console.log(response.message);
                    if (response.success) {

                        $.notify({
                            title: "Attention : ",
                            message: response.message,
                            icon: 'fa fa-check'
                        }, {
                            type: "info"
                        });

                        // reload page
                        location.reload(true);
                    }

                    if (!response.success) {
                        console.log(response.message);
                        var error = "<ul class='bg-danger text-danger'>";
                        $.each(response.message, function (key, value) {
                            error += "<li>" + value + "</li>"
                        })
                        error += "</ul>";
                        $('#errorMsg').html(error)

                    }

                });


            });

        </script>
