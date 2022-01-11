<div class="row">
    <div class="col-md-2">
        <strong>Name:</strong>
    </div>
    <div class="col-md-8">
        <p class="card-description">{{$followupTarget->fname}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <strong>Email:</strong>
    </div>
    <div class="col-md-8">
        <p class="card-description">{{$followupTarget->email}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <strong>Phone:</strong>
    </div>
    <div class="col-md-8">
        <p class="card-description">{{$followupTarget->phone}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <strong>Status:</strong>
    </div>
    <div class="col-md-8">
        <p class="card-description">{{$followupTarget->status}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <strong>Church:</strong>
    </div>
    <div class="col-md-8">
        <p class="card-description">{{$followupTarget->church->name}}</p>
    </div>
</div>