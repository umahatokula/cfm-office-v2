@extends('frontend.layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>All Follow Up Targets</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget widget-stats-large">
                        <div class="row">
                            <div class="col-xl-8">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Age Profile</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Church</th>
                                            <th scope="col">Assigned By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($followupTargets as $key => $followupTarget)
                                        <tr>
                                            <th scope="row"> {{ $key+1 }} </th>
                                            <td> {{$followupTarget->fname}} </td>
                                            <td> {{$followupTarget->lname}} </td>
                                            <td> {{$followupTarget->phone}} </td>
                                            <td> {{$followupTarget->email}} </td>
                                            <td> {{$followupTarget->age_profile_id}} </td>
                                            <td> {{$followupTarget->status}} </td>
                                            <td> {{$followupTarget->church_id}} </td>
                                            <td> {{$followupTarget->assigned_by}} </td>
                                            <td>
                                                <div class="row ml-1 p-2 mx-auto">
                                                    <div class="action_btn ml-1 p-1">
                                                        <a href="{{ route('show-target', $followupTarget)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                    <div class="action_btn ml-1 p-1">
                                                        <a href="{{ route('edit-target', $followupTarget)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="action_btn ml-1 p-1">
                                                        <form action="{{ route('delete-target', $followupTarget)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                            No FOLLOW UP AVAILABLE
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {!! $followupTargets->links() !!}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
