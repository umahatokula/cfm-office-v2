@extends('frontend.layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Create New Target</h1>
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
                                        <form class="row g-3" method="POST" action=" {{ route('store-target') }} ">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-6">
                                                <label for="Email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="Email" name="email" value=" {{ $followupTarget->email }} ">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" name="fname" value=" {{ $followupTarget->fname }} ">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname" value=" {{ $followupTarget->lname }} ">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value=" {{ $followupTarget->phone }} ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="age_profile" class="form-label">Age Profile</label>
                                                <select id="age_profile" class="form-select" name="age_profile">
                                                    <option selected value=" {{ $followupTarget->age_profile_id }} ">Age Profile {{ $followupTarget->age_profile_id }}</option>
                                                    <option value="1">Age Profile 1</option>
                                                    <option value="2">Age Profile 2</option>
                                                    <option value="3">Age Profile 3</option>
                                                    <option value="4">Age Profile 4</option>
                                                </select>
                                            </div>
                                      <div class="col-md-4">
                                                <label for="status" class="form-label">State</label>
                                                <select id="status" class="form-select" name="status">
                                                    <option selected value=" {{ $followupTarget->status }} ">Status {{ $followupTarget->status }}</option>
                                                    <option value="1">Status 1</option>
                                                    <option value="2">Status 2</option>
                                                    <option value="3">Status 3</option>
                                                    <option value="4">Status 4</option>
                                                </select>
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
