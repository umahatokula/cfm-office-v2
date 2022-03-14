  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          <h4 class="text-center">SERVICE TEAMS</h4>


          <!-- cells -->
          <div class="row">
            <div class="col-xs-12 bg-primary text-center" style="padding: 5px; margin: 10px 0px">
              Service Teams
            </div>
          </div>

          {!! Form::open(['route' => 'members.service-teams', 'method' => 'POST', 'class' => 'form-horizontal ajaxForm']) !!}

          <input name="member_id" value="{{ $member->id }}" type="hidden">

          @if($serviceTeams->count() > 0)
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              @foreach($serviceTeams as $serviceTeams)
              <tr>
                <td>{{ $serviceTeams->name }}</td>
                <td>
                  <input name="service_team_id[]" value="{{ $serviceTeams->id }}" type="checkbox" class="serviceTeams" {{ in_array($serviceTeams->id, $myServiceTeams) ? 'checked' : '' }}>
                </td>
              </tr> 
              @endforeach
              <tr>
                <td colspan="2" class="text-center">
                  <button class="btn btn-xs btn-info">Save</button>
                </td>
              </tr>
            </table>
          </div>
          @else
          <div class="panel panel-default">
            <div class="panel-body">
              There are no suggested service teams.
            </div>
          </div>
          @endif
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  $('.ajaxForm').ajaxForm(function(resp) {
      window.location.replace("{{ route('members.show', $member->id) }}");
    });
  </script>
