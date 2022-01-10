@extends('layouts.app')

@section('content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Report Editor</h1>
                        <span>Write your Target report here.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('update-report', $report->follow_up_target_id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <textarea name="report" id="summernote">{{$report->report}} </textarea>
                                <button class="btn btn-success" type="submit"><i class="material-icons-outlined no-m">edit</i>  UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


