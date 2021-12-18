<div class="row">
    <div class="col-12">
        <form class="row g-3" method="POST" action=" {{ route('followup-targets.assign.store') }} ">
            @csrf

            <h4>
                <b>{{ $target->name }}</b>
                <input type="hidden" name="target_id" value="{{ $target->id }}">
            </h5>
            <div class="col-md-4">
                <select id="status" class="form-select" name="coach_id">
                    <option value="" selected>Choose Life Coach...</option>
                    @forelse ($lifeCoaches as $lifeCoach)
                    <option value="{{$lifeCoach->id}}">{{$lifeCoach->lname}} {{$lifeCoach->fname}}</option>
                    @empty
                    <option value="">No Coaches Available</option>
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
