<div class="row">
    <div class="col-md-12 mb-2"><strong>Date</strong></div>
    <div class="col-md-12 mb-2 mb-md-4">{{ $report->created_at ? $report->created_at->toFormattedDateString() : null }}</div>
</div>

<div class="row">
    <div class="col-md-12 mb-2"><strong>Coach</strong></div>
    <div class="col-md-12 mb-2 mb-md-4">
        <a href="{{ route('life-coaches.show', $report->life_coach) }}">{{ $report->life_coach->name }}</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-2"><strong>Report</strong></div>
    <div class="col-md-12 mb-2 mb-md-4">{{ $report->report }}</div>
</div>

<div class="row">
    <div class="col-md-12 mb-2"><strong>Pastor's comment</strong></div>
    <div class="col-md-12 mb-2 mb-md-4">{{ $report->pastors_comment }}</div>
</div>