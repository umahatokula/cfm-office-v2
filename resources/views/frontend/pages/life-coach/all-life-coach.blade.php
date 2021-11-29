@extends('frontend.layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>All Life Coaches</h1>
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
                                            <th width="20%" scope="col"><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($coaches as $key => $coach)
                                        <tr>
                                            <th scope="row"> {{ $key+1 }} </th>
                                            <td>{{$coach->fname}}</td>
                                            <td>{{$coach->lname}}</td>
                                            <td>{{$coach->phone}}</td>
                                            <td>{{$coach->email}}</td>
                                            <td>
                                                <div class="row ml-1 p-2 mx-auto">
                                                    <div class="action_btn ml-1 p-1">
                                                        <a href="{{ route('show-life-coach', $coach)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                    <div class="action_btn ml-1 p-1">
                                                        <a href="{{ route('edit-life-coach', $coach)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="action_btn ml-1 p-1">
                                                        <form action="{{ route('delete-life-coach', $coach)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        @empty
                                            No COACH AVAILABLE
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $coaches->links() !!}
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
