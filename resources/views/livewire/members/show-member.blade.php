<div class="content-wrapper">
    <div class="page-title">
        <div>
            <h4>{{ $member->fname }} {{ $member->lname }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="{{ route('involements.show', $member->id) }}" class="btn btn-default"
                                    data-target="#myModal" data-toggle="modal">Involvment</a>
                                <a href="{{ route('growth-path.show', $member->id) }}" class="btn btn-default"
                                    data-target="#myModal" data-toggle="modal">Growth Path</a>
                                <a href="{{ route('family.show', $member->id) }}" class="btn btn-default"
                                    data-target="#myModal" data-toggle="modal">Family</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="user-info-sidebar text-center">
                                <img src="{{ asset('/uploads/' . $member->picture_path) }}"
                                    class="img-cirlce img-responsive img-thumbnail" alt="{{$member->fname}}" />
                                <hr>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="{!! route('members.edit', array($member)) !!}"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" id="deleteMember"
                                        data-id="{{ $member }}">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-hover table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="text-center"><strong>
                                                        <h5>Bio Info</h5>
                                                    </strong></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"><strong>Name</strong></td>
                                                <td>{!! $member->fname.' '.$member->mname.' '.$member->lname !!}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Gender</strong></td>
                                                <td>
                                                    @if($member->gender)
                                                    {!! $member->gender->gender !!}
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Age Profile</strong></td>
                                                <td>
                                                    @if($member->ageProfile)
                                                    {!! $member->ageProfile->age_member !!}
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td>{!! $member->email !!}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>Phone</strong></td>
                                                <td>{!! $member->phone !!}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>Birthday</strong></td>
                                                <td>
                                                    @if($member->dob)
                                                    {!! $member->dob !!} ({{ $member->age }} years)
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Occupation</strong></td>
                                                <td>
                                                    {!! $member->occupation !!}
                                                </td>
                                            </tr>

                                            {{-- <tr>
                          <td><strong>Country</strong></td>
                          <td>
                            @if($member->country)
                            {!! $member->country->name !!}
                            @endif
                          </td>
                        </tr> --}}

                                            <tr>
                                                <td><strong>State</strong></td>
                                                <td>
                                                    @if($member->state)
                                                    {!! $member->state->name !!}
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>LGA</strong></td>
                                                <td>
                                                    @if($member->local)
                                                    {!! $member->local->local_name !!}
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><strong>Address</strong></td>
                                                <td>{!! $member->address !!}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>Region</strong></td>
                                                <td>
                                                    @if($member->memberRegion)
                                                    {!! $member->memberRegion->region !!}
                                                    @endif
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="text-center"><strong>
                                                        <h5>Church Info</h5>
                                                    </strong></td>
                                            </tr>

                                            <tr>
                                                <td><strong>Church</strong></td>
                                                <td>
                                                    @if($member->church)
                                                    {!! $member->church->name !!}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Cell</strong></td>
                                                <td>
                                                    @if($member->cell)
                                                    {!! $member->cell->name !!}
                                                    @endif
                                                    <span style="font-size: 10px; float: right"><a
                                                            href="{{ route('cells.suggest', $member->id) }}"
                                                            id="suggestCells" data-target="#myModal"
                                                            data-toggle="modal">edit</a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Service Teams</strong></td>
                                                <td>
                                                    @if($member->serviceTeams)
                                                    @foreach($member->serviceTeams as $serviceTeam)
                                                    {!! $serviceTeam->serviceTeam->name !!} <br>
                                                    @endforeach
                                                    @endif
                                                    <span style="font-size: 10px; float: right"><a
                                                            href="{{ route('service-teams.suggest', $member->id) }}"
                                                            id="suggestServiceTeams" data-target="#myModal"
                                                            data-toggle="modal">edit</a></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <tbody>

                                            <tr>
                                                <td colspan="2" class="text-center"><strong>
                                                        <h5>Social Info</h5>
                                                    </strong></td>
                                            </tr>

                                            <tr>
                                                <td><strong>Facebook</strong></td>
                                                <td>
                                                    {!! $member->facebook !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Twitter</strong></td>
                                                <td>
                                                    {!! $member->twitter !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Instagram</strong></td>
                                                <td>
                                                    {!! $member->instagram !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Whatsapp Number</strong></td>
                                                <td>
                                                    {!! $member->whatsapp !!}
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
