@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="page-description d-flex align-items-center">
            <div class="page-description-content flex-grow-1">
                <h1>Life Coaches</h1>
                <span>List of all Life Coaches</span>
            </div>
            <div class="page-description-actions">
                <a href="#" class="btn btn-dark"><i class="material-icons-outlined">file_download</i>Download</a>
                <a href="{{ route('life-coaches.create') }}" class="btn btn-primary"><i class="material-icons">add</i>Create</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">&nbsp</h5>
            </div>
            <div class="card-body">

                @if(count($errors) > 0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <ul class="p-0 m-0" style="list-style: none;">
                      @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                      @endforeach
                  </ul>
                </div>
                @endif
                
                <div class="table-responsive">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">First</th>
                              <th scope="col">Last</th>
                              <th scope="col">Phone</th>
                              <th scope="col">E-mail</th>
                              <th scope="col"><center>Action</center></th>
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
                              <td class="text-center">
                                  <a href="{{ route('life-coaches.show', $coach)}}" class="text-primary p-0" data-original-title="" title="Details">
                                      <span class="material-icons-outlined">visibility</span>
                                  </a>
                                  <a href="{{ route('life-coaches.edit', $coach)}}" class="text-success p-0" data-original-title="" title="Edit">
                                      <span class="material-icons-outlined">edit</span>
                                  </a>
                                  <a href="{{ route('life-coaches.destroy', $coach)}}" class="text-danger p-0" data-original-title="" title="Delete">
                                      <span class="material-icons-outlined">delete</span>
                                  </a>
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
@endsection
