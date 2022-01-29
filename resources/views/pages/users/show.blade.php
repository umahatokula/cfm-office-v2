<div class="table-responsive">
    <table class="table table-condensed table-hover table-bordered">
        <tbody>
            <tr>
                <td colspan="2" class="text-center"><strong>
                        <h5>Bio Info</h5>
                    </strong></td>
            </tr>
            <tr>
                <td style="width:25%"><strong>Name</strong></td>
                <td>
                    @if($user->member)
                    {!! $user->member->fname.' '.$user->member->mname.' '.$user->member->lname !!}
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Gender</strong></td>
                <td>
                    @if($user->member->gender)
                    {!! $user->member->gender->gender !!}
                    @endif
                </td>
            </tr>

            <tr>
                <td><strong>Email</strong></td>
                <td>{!! $user->member->email !!}</td>
            </tr>

            <tr>
                <td><strong>Phone</strong></td>
                <td>{!! $user->member->phone !!}</td>
            </tr>

            <tr>
                <td><strong>Birthday</strong></td>
                <td>
                    @if($user->member->dob)
                    {!! $user->member->dob !!} ({{ $user->member->age }} years)
                    @endif
                </td>
            </tr>

            <tr>
                <td><strong>Occupation</strong></td>
                <td>
                    {!! $user->member->occupation !!}
                </td>
            </tr>

            <tr>
                <td><strong>Country</strong></td>
                <td>
                    @if($user->member->country)
                    {!! $user->member->country->name !!}
                    @endif
                </td>
            </tr>

            <tr>
                <td><strong>State</strong></td>
                <td>
                    @if($user->member->state)
                    {!! $user->member->state->name !!}
                    @endif
                </td>
            </tr>

            <tr>
                <td><strong>LGA</strong></td>
                <td>
                    @if($user->member->local)
                    {!! $user->member->local->local_name !!}
                    @endif
                </td>
            </tr>

            <tr>
                <td><strong>Address</strong></td>
                <td>{!! $user->member->address !!}</td>
            </tr>

            <tr>
                <td><strong>Region</strong></td>
                <td>
                    @if($user->member->memberRegion)
                    {!! $user->member->memberRegion->region !!}
                    @endif
                </td>
            </tr>

        </tbody>
    </table>
</div>
