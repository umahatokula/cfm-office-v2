@extends('frontend.layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget widget-stats-large">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="widget-stats-large-chart-container">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="page-description">
                                                    <h1>{{ $lifeCoach->fname }}'s</h1>
                                                    <span>{{$lifeCoach->email}}</span>
                                                    <span>{{$lifeCoach->phone}}</span>
                                                </div>
                                                <div class="card-header">
                                                    <h5 class="card-title">{{ $lifeCoach->lname }}</h5>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p class="card-description">{{$lifeCoach->email}}</p>
                                                        <p class="card-description">{{$lifeCoach->phone}}</p>
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
            </div>
        </div>
    </div>
</div>
@endsection
