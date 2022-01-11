<div>
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    <h1>Target Reports</h1>
                    <span>List of all Target Reports</span>
                </div>
                <div class="page-description-actions">
                    <button wire:click="onClickPastorReportForm" href="#" class="btn btn-dark"><i class="material-icons">add</i>Pastor's Comment</button>
                    <button wire:click="onClickCoachReportForm" href="#" class="btn btn-primary"><i class="material-icons">add</i>Life Coach's Comment</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Reports</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Report By</th>
                                <th class="text-end">Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $report->created_at ? $report->created_at->toFormattedDateString() : null }}</td>
                                    <td>{{ $report->life_coach ? $report->life_coach->name : null }}</td>
                                    <td class="text-end">
                                        <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('followup-reports.show', $report)}}" href="#" class="text-primary p-0" data-bs-toggle="modal" data-bs-target="#modal-large" title="Details">
                                            <span class="material-icons-sharp">visibility</span>
                                        </a>
                                        <a wire:click="editReport({{ $report->id }})" href="#" class="text-success p-0" data-original-title="" title="Edit">
                                            <span class="material-icons-outlined">edit</span>
                                        </a>
                                        <a wire:click.prevent="destroy({{ $report->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" href="#" class="text-danger p-0" data-original-title="" title="Delete">
                                            <span class="material-icons-outlined">delete</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No reports</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $showPastorReportForm ? 'Pastor\'s Comment' :  ($editReport ? 'Edit Report' : 'Coach\'s Report') }} </h5>
                </div>
                <div class="card-body">

                    @if ($showCoachReportForm)
                    <form wire:submit.prevent="save">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <textarea wire:model="report_content" id="summernote" class="form-control" rows="5" placeholder="Enter report..."></textarea>
                                @error('report_content') <small class="text-danger">This field is required</small>  @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success" type="submit"><i class="material-icons-outlined no-m">edit</i>  SUBMIT</button>
                            </div>
                        </div>
                    </form>  
                    @endif

                    @if ($showPastorReportForm)
                    <form wire:submit.prevent="savePastorComment">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <select wire:model.lazy="reportIdForPastorComment" wire:change="onSelectReport($event.target.value)" class="form-select form-control"
                                    required>
                                    <option value="">Please select one</option>
                                    @foreach ($reports as $report)
                                    <option value="{{ $report->id }}">{{ $report->created_at ? $report->created_at->toFormattedDateString() : null }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <textarea wire:model="pastor_report_content" id="summernote" class="form-control" rows="5" placeholder="Enter report..."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-dark" type="submit"><i class="material-icons-outlined no-m">edit</i>  SUBMIT</button>
                            </div>
                        </div>
                    </form>  
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
