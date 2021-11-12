@extends('frontend.layouts.app')

@section('content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card todo-container">
                        <div class="row">
                            <div class="col-xl-4 col-xxl-3">
                                <div class="todo-menu">
{{--
                                    <h5 class="todo-menu-title">Status</h5>
                                    <ul class="list-unstyled todo-status-filter">
                                        <li><a href="#" class="active"><i class="material-icons-outlined">format_list_bulleted</i>All</a></li>
                                        <li><a href="#"><i class="material-icons-outlined">done</i>Completed</a></li>
                                        <li><a href="#"><i class="material-icons-outlined">pending</i>In Progress</a></li>
                                        <li><a href="#"><i class="material-icons-outlined">delete</i>Deleted</a></li>
                                    </ul> --}}
                                    <a href="#" class="btn btn-primary d-block m-b-lg">Create new</a>

                                    <h5 class="todo-menu-title">Search</h5>
                                    <input type="text" class="form-control form-control-solid m-b-lg" placeholder="Type here..">

                                    <h5 class="todo-menu-title">Labels</h5>
                                    <div class="todo-label-filter m-b-lg">
                                        <a href="#" class="badge badge-style-light rounded-pill badge-light">general</a>
                                        <a href="#" class="badge badge-style-light rounded-pill badge-primary">work</a>
                                        <a href="#" class="badge badge-style-light rounded-pill badge-secondary">family</a>
                                        <a href="#" class="badge badge-style-light rounded-pill badge-danger">education</a>
                                        <a href="#" class="badge badge-style-light rounded-pill badge-info">side projects</a>
                                        <a href="#" class="badge badge-style-light rounded-pill badge-success">personal</a>
                                        <a href="#" class="badge badge-style-light rounded-pill badge-warning">other</a>
                                    </div>
                                    {{-- <h5 class="todo-menu-title">Preferences</h5>
                                    <div class="todo-preferences-filter">
                                        <div class="todo-preferences-item">
                                            <input class="form-check-input" type="checkbox" value="" id="createdByMeCheck">
                                            <label class="form-check-label" for="createdByMeCheck">
                                                Created by me
                                            </label>
                                        </div>
                                        <div class="todo-preferences-item">
                                            <input class="form-check-input" type="checkbox" value="" id="withoutDeadlineCheck">
                                            <label class="form-check-label" for="withoutDeadlineCheck">
                                                Without deadline
                                            </label>
                                        </div>
                                        <div class="todo-preferences-item">
                                            <input class="form-check-input" type="checkbox" value="" id="highPriorityCheck" checked>
                                            <label class="form-check-label" for="highPriorityCheck">
                                                High priority
                                            </label>
                                        </div>
                                        <div class="todo-preferences-item">
                                            <input class="form-check-input" type="checkbox" value="" id="recentActivity">
                                            <label class="form-check-label" for="recentActivity">
                                                Recent activity
                                            </label>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9">
                                <div class="todo-list">
                                    <ul class="list-unstyled">
                                            @forelse ($reports as $report)
                                            <li class="todo-item">

                                                <div class="todo-item-content">
                                                    <span class="todo-item-title">Report For {{$report->created_at->format('d-m-Y')}} </span>
                                                    <span class="todo-item-subtitle">{{$report->report}}</span>
                                                </div>
                                                <div class="todo-item-actions">
                                                    <a href="#" class="todo-item-done"><i class="material-icons-outlined no-m">preview</i></a>
                                                    <a href="#" class="todo-item-done"><i class="material-icons-outlined no-m">edit</i></a>
                                                    <a href="#" class="todo-item-delete"><i class="material-icons-outlined no-m">delete_outline</i></a>
                                                </div>

                                            @empty
                                                <div class="todo-item-content">
                                                    <span class="todo-item-title">NO reports available<span class="badge badge-style-light rounded-pill badge-warning">other</span></span>
                                                    <span class="todo-item-subtitle">Donec ultricies est vel tellus molestie volutpat. Duis at cursus risus.</span>
                                                </div>
                                            </li>

                                            @endforelse
                                    </ul>
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
