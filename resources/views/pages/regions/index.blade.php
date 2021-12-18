  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <td class="text-center">#</td>
                <td class="text-center">Region</td>
                <td class="text-center">No. of Cells</td>
                <td class="text-center">No. of Members</td>
              </tr>
            </thead>
            <tbody>
              @if($regions->count() > 0)
              @foreach($regions as $region)
              <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $region->region }}</td>
                <td class="text-center">{{ $region->cells->count()  }}</td>
                <td class="text-center">{{ $region->members->count() }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>