<div class="row">
    <div class="col-12">
        <form class="row g-3" method="POST" action=" {{ route('life-coaches.assign.store') }} ">
            @csrf

            <h4>
                <b>{{ $lifeCoach->name }}</b>
                <input type="hidden" name="coach_id" value="{{ $lifeCoach->id }}" style="margin: auto">
            </h5>
            <div class="col-md-4">
                <select id="status" class="form-select" name="target_id">
                    <option value="" selected>Choose a Target...</option>
                    @forelse ($followupTargets as $followupTarget)
                    <option value="{{$lifeCoach->id}}">{{$followupTarget->lname}} {{$followupTarget->fname}}</option>
                    @empty
                    <option value="">No targets available</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-4">
                <select id="status" class="form-select" name="reason_id">
                    <option value="" selected>Choose Follow-up reason...</option>
                    @forelse ($followupReasons as $reason)
                    <option value="{{$reason->id}}">{{ $reason->reason }}</option>
                    @empty
                    <option value="">No reason Available</option>
                    @endforelse

                </select>
            </div>
            <div class="col-4">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Assign</button>
                </div>
            </div>
        </form>
    </div>
</div>
