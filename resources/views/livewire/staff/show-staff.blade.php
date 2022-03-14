

<div class="content-wrapper">
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    &nbsp;
                </div>
                <div class="page-description-actions">
                    <a href="{{ route('staff.bankDetails.create', $staff) }}" class="btn btn-success">Bank Details</a>
                    <a href="{!! route('staff.edit', array($staff)) !!}" class="btn btn-info">Edit</a>
                    <a href="#" class="btn btn-danger" id="deleteStaff">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="page-description">
                <div class="page-description-actions">
                    
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <div class="col-md-4"><b>Name:</b></div>
                                            <div class="col-md-4">{{ $staff->name }}</div>
                                            <div class="col-md-4">
                                                <img src="{{ $staff->getFirstMediaUrl('staff') }}" class="img-responsive img-thumbnail" alt="{{$staff->fname}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4"><b>Gender:</b></div>
                                            <div class="col-md-8">{{ $staff->gender->gender }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4"><b>Email:</b></div>
                                            <div class="col-md-8">{{ $staff->email }}</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4"><b>Phone number:</b> </div>
                                            <div class="col-md-8">{{ $staff->phone }}</div>
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
