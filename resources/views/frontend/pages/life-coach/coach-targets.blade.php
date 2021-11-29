@extends('frontend.layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Your Current Targets</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget widget-stats-large">
                        <div class="row">
                            <div class="col">
                                <table class="table table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">E-mail</th>
                                            <th width="20%" scope="col"><center>Target Report</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($folks as $key => $folk)
                                        <tr>
                                            <th scope="row"> {{ $key+1 }} </th>
                                            <td>{{$folk->fname}}</td>
                                            <td>{{$folk->lname}}</td>
                                            <td>{{$folk->phone}}</td>
                                            <td>{{$folk->email}}</td>
                                            <td>
                                                <div class="row ml-1 p-2 mx-auto">
                                                    <div class="action_btn ml-1 p-1">
                                                        <a href="{{ route('all-reports', $folk)}}" class="btn btn-secondary"><i class="material-icons">preview</i>View</a>
                                                    </div>
                                                    <div class="action_btn ml-1 p-1">
                                                        <a href="{{ route('show-life-coach', $folk)}}" class="btn btn-primary"><i class="material-icons">add</i>Add</a>
                                                    </div>
                                                    <div class="action_btn ml-1 p-1">
                                                        <a href="{{ route('edit-life-coach', $folk)}}" class="btn btn-danger"><i class="material-icons">edit</i>Edit</a>
                                                    </div>
                                                    <div class="action_btn ml-1 p-1">
                                                        <form action="{{ route('delete-life-coach', $folk)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-success"><i class="material-icons-outlined">delete_outline</i>Remove</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            @empty
                                                No COACH AVAILABLE
                                            @endforelse
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {{-- {!! $coaches->links() !!} --}}
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
