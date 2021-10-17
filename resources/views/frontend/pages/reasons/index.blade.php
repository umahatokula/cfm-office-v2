  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <td class="text-center">#</td>
                <td class="text-center">Reasons</td>
                <td class="text-center">No. of Members</td>
              </tr>
            </thead>
            <tbody>
              @if($reasons->count() > 0)
              @foreach($reasons as $reason)
              <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $reason->reason }}</td>
                <td class="text-center">{{ $reason->followUps->count() }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>