<div class="row">
	<div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">

              @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              {!! Form::model($serviceTeam, ['route' => ['service-teams.update', $serviceTeam->id], 'method' => 'PUT',  'class' => '', 'role' => 'form']) !!}

              <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'control-label', 'for' => 'name']) !!}

                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}

              </div>

              <div class="form-group-separator"></div>

              <div class="form-group">
                {!! Form::label('description', 'Description', ['class' => 'control-label', 'for' => 'description']) !!}

                {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'required']) !!}

              </div>

              <div class="form-group-separator"></div>

              <div class="form-group">
                {!! Form::label('leader', 'Leader', ['class' => 'control-label', 'for' => 'leader']) !!}

                {!! Form::select('leader', $members, null, ['class' => 'form-control', 'id' => 'leader', 'placeholder' => 'Select one', 'required']) !!}

              </div>

              <div class="form-group-separator"></div>

              <div class="form-group">

                {!! Form::submit('Edit Service Team', ['class' => 'btn btn-primary', 'id' => 'add-user']) !!}

              </div>

              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>