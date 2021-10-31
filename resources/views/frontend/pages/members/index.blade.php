@extends('frontend.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description">
			<div class="row">
				<div class="col-md-6">
					<h1>Members</h1>
					<span>CFC Members. Can be filtered by center</span>
				</div>
				<div class="col-md-6 d-flex justify-content-end">
					&nbsp
				</div>
			</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['route' => 'members.index']) !!}
                        {!! Form::select('search', $churches, ['class' => 'form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="{{ route('members.create') }}" class="btn btn-primary btn-lg">Add member</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="example-container">
                    <div class="example-content">
                        <table class="table">
                            <thead>
                                <tr>
									<th class="text-center">#</th>
									<th class="text-center">Name and Role</th>
									<th class="text-center">Church</th>
									<th class="text-center">E-Mail</th>
									<th class="text-center">Phone</th>
									<th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

								@foreach($members as $member)
                                <tr>
                                    <td class="text-center"> {{ $loop->iteration }} </td>
                                    <td>
                                        {{$member->fname. ' '. $member->lname}}
                                    </td>
                                    <td class="text-left"> {{ $member->church ? $member->church->name : null }} </td>
                                    <td class="text-center"> <span class="email">{{$member->email}}</span> </td>
                                    <td class="text-center"> {{$member->phone}} </td>
                                    <td class="text-center">
										<a href="{{ route('members.show', array($member->id)) }}" class="btn btn-primary btn-sm"> View Profile </a>
										<a href="{{ route('members.delete', $member->id) }}" class="btn btn-danger btn-sm"> Delete </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="example-code">
                        <pre><code class="html"></code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection