@extends('frontend.layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Create New Coach</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget widget-stats-large">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="widget-stats-large-chart-container">
                                    <div class="card-header">
                                        <h5 class="card-title"><span class="badge badge-light badge-style-light"> TODAY</span></h5>
                                    </div>
                                    <div class="card-body">
                                        <form class="row g-3" method="POST" action=" {{ route('store-life-coach') }} ">
                                            @csrf
                                            <div class="col-md-6">
                                                <label for="Email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="Email" name="email">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" name="fname">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone">
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        </form>
                                    </div>
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
