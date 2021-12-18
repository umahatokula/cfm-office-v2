@extends('layouts.editor')

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
                            <form action="{{ route('store-report', $folk)}}" method="post">
                                @csrf
                                <textarea name="report" id="summernote">Hello </textarea>
                                <button class="btn btn-success" type="submit"><i class="material-icons-outlined no-m">edit</i>  SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


