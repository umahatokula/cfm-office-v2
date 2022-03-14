@extends('layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Assign Coach/Follow-Up</h1>
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
                                        <form class="row g-3" method="POST" action=" {{ route('assign-target') }} ">
                                            @csrf

                                            <div class="col-md-4">
                                                <label for="age_profile" class="form-label">Targets</label>
                                                <select id="age_profile" class="form-select" name="targets">
                                                    <option selected>Choose...</option>
                                                    @forelse ($followUpTargets as $followUpTarget)
                                                    <option value="{{$followUpTargets->id}}">{{$followUpTargets->lname}} {{$followUpTargets->fname}}</option>
                                                    @empty

                                                    <option value="">No Targets Available</option>
                                                    @endforelse

                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="status" class="form-label">Coaches</label>
                                                <select id="status" class="form-select" name="coaches">
                                                    <option selected>Choose...</option>
                                                    @forelse ($lifeCoaches as $lifeCoach)
                                                    <option value="{{$lifeCoach->id}}">{{$lifeCoach->lname}} {{$lifeCoach->fname}}</option>
                                                    @empty
                                                    <option value="">No Coaches Available</option>
                                                    @endforelse

                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Assign</button>
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
