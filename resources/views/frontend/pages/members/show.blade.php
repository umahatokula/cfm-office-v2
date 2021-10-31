@extends('frontend.layouts.app')
@section('content')

<div class="content-wrapper">
  <div class="page-title">
    <div>
      <h1>Profile: {{ $profile->fname }} {{ $profile->lname }}</h1>
      <!-- <p>Start a beautiful journey here</p> -->
    </div>
    <div>
      <a href="{{ route('members.create') }}" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal"><i class="fa fa-lg fa-plus"></i></a>
      <a href="#" class="btn btn-info btn-flat"><i class="fa fa-lg fa-refresh"></i></a>
      <a href="#" class="btn btn-warning btn-flat"><i class="fa fa-lg fa-trash"></i></a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="btn-group" role="group" aria-label="...">
                <a href="{{ route('involements.show', $profile->id) }}" class="btn btn-default" data-target="#myModal" data-toggle="modal">Involvment</a>
                <a href="{{ route('growth-path.show', $profile->id) }}" class="btn btn-default" data-target="#myModal" data-toggle="modal">Growth Path</a>
                <a href="{{ route('family.show', $profile->id) }}"class="btn btn-default" data-target="#myModal" data-toggle="modal">Family</a>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-sm-4">
              <div class="user-info-sidebar text-center">
                <img src="{{ asset('/uploads/' . $profile->picture_path) }}" class="img-cirlce img-responsive img-thumbnail" alt="{{$profile->fname}}" />
                <hr>
                <div class="btn-group" role="group" aria-label="...">
                  <a href="{!! route('members.edit', array($profile->id)) !!}" class="btn btn-info btn-sm">Edit</a>
                  <a href="#" class="btn btn-danger btn-sm" id="deleteMember" data-id="{{ $profile->id }}">Delete</a>
                </div>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-condensed table-hover table-bordered">
                    <tbody>
                      <tr>
                        <td colspan="2" class="text-center"><strong><h5>Bio Info</h5></strong></td>
                      </tr>
                      <tr>
                        <td style="width:25%"><strong>Name</strong></td>
                        <td>{!! $profile->fname.' '.$profile->mname.' '.$profile->lname !!}</td>
                      </tr>
                      <tr>
                        <td><strong>Gender</strong></td>
                        <td>
                          @if($profile->gender)
                          {!! $profile->gender->gender !!}
                          @endif
                        </td>
                      </tr>

                      <tr>
                        <td><strong>Age Profile</strong></td>
                        <td>
                          @if($profile->ageProfile)
                          {!! $profile->ageProfile->age_profile !!}
                          @endif
                        </td>
                      </tr>

                      <tr>
                        <td><strong>Email</strong></td>
                        <td>{!! $profile->email !!}</td>
                      </tr>

                      <tr>
                        <td><strong>Phone</strong></td>
                        <td>{!! $profile->phone !!}</td>
                      </tr>

                      <tr>
                        <td><strong>Birthday</strong></td>
                        <td>
                          @if($profile->dob)
                          {!! $profile->dob !!} ({{ $profile->age }} years)
                          @endif
                        </td>
                      </tr>

                      <tr>
                        <td><strong>Occupation</strong></td>
                        <td>
                          {!! $profile->occupation !!}
                        </td>
                      </tr>

                      {{-- <tr>
                        <td><strong>Country</strong></td>
                        <td>
                          @if($profile->country)
                          {!! $profile->country->name !!}
                          @endif
                        </td>
                      </tr> --}}

                      <tr>
                        <td><strong>State</strong></td>
                        <td>
                          @if($profile->state)
                          {!! $profile->state->name !!}
                          @endif
                        </td>
                      </tr>

                      <tr>
                        <td><strong>LGA</strong></td>
                        <td>
                          @if($profile->local)
                          {!! $profile->local->local_name !!}
                          @endif
                        </td>
                      </tr>

                      <tr>
                        <td><strong>Address</strong></td>
                        <td>{!! $profile->address !!}</td>
                      </tr>

                      <tr>
                        <td><strong>Region</strong></td>
                        <td>
                          @if($profile->memberRegion)
                          {!! $profile->memberRegion->region !!}
                          @endif
                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
                <div class="col-md-12">
                  <table class="table table-condensed table-bordered">
                    <tbody>
                      <tr><td colspan="2" class="text-center"><strong><h5>Church Info</h5></strong></td></tr>

                      <tr>
                        <td><strong>Church</strong></td>
                        <td>
                          @if($profile->church)
                          {!! $profile->church->name !!}
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Cell</strong></td>
                        <td>
                          @if($profile->cell)
                          {!! $profile->cell->name !!}
                          @endif
                          <span style="font-size: 10px; float: right"><a href="{{ route('cells.suggest', $profile->id) }}" id="suggestCells" data-target="#myModal" data-toggle="modal">edit</a></span>
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Service Teams</strong></td>
                        <td>
                          @if($profile->serviceTeams)
                          @foreach($profile->serviceTeams as $serviceTeam)
                          {!! $serviceTeam->serviceTeam->name !!} <br>
                          @endforeach
                          @endif
                          <span style="font-size: 10px; float: right"><a href="{{ route('service-teams.suggest', $profile->id) }}"  id="suggestServiceTeams" data-target="#myModal" data-toggle="modal">edit</a></span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12">
                  <table class="table table-condensed table-bordered">
                    <tbody>

                      <tr><td colspan="2" class="text-center"><strong><h5>Social Info</h5></strong></td></tr>

                      <tr>
                        <td><strong>Facebook</strong></td>
                        <td>
                          {!! $profile->facebook !!}
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Twitter</strong></td>
                        <td>
                          {!! $profile->twitter !!}
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Instagram</strong></td>
                        <td>
                          {!! $profile->instagram !!}
                        </td>
                      </tr>
                      <tr>
                        <td><strong>Whatsapp Number</strong></td>
                        <td>
                          {!! $profile->whatsapp !!}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('page_css')

@stop


@section('page_js')
<script type="text/javascript">

  $('#deleteMember').click(function() {
    swal({
      title: "Are you sure?",
      text: "Are you sure you want to delete this member?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: true
    }, function() {
      var id = $('#deleteMember').data('id');

      $.ajax({
        url: "{{ url('members/delete') }}" + "/" + id,
        type: 'GET',
        datatype: 'JSON',
        context:this,
        success: function (resp) {
            // console.log(resp);
            if(resp.success) {

              swal("Deleted!", "Member\'s record has been deleted.", "success");

              window.location.replace("{{ route('members.index') }}");

            } else {

              swal("Cancelled", "Member\'s record is safe :)", "error");

            }

          },
          error: function(xhr, status, error) {
            $.notify({
              title: "Attention : ",
              message: xhr.message,
              icon: 'fa fa-check' 
            },{
              type: "danger"
            });
          }

        });
    });
  });

</script>
@stop

