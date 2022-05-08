<div>
    <div class="table-responsive-md">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Requisition Number</th>
                    <th class="text-center">Requested By</th>
                    <th class="text-end">Amount</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action(s)</th>
                </tr>
            </thead>
            <tbody>

                @foreach($requisitions as $requisition)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">
                        {{ $requisition->requisition_number }}
                    </td>
                    <td>
                        @if($requisition->requisitionBy)
                        {{ $requisition->requisitionBy->fname }}
                        {{ $requisition->requisitionBy->lname }}
                        @endif
                    </td>
                    <td class="text-end">{{ number_format($requisition->requisitionItems->sum('total_cost'), 2) }}</td>
                    <td class="text-center">
                        @if($requisition->status)
                        <span
                            class="badge {{ $requisition->status_id == 3 ? 'badge-success' : '' }} {{ $requisition->status_id == 4 ? 'badge-dark' : '' }} {{ $requisition->status_id == 5 ? 'badge-danger' : '' }} {{ $requisition->status_id == 6 ? 'badge-info' : '' }} {{ $requisition->status_id == 7 ? 'badge-danger' : '' }}">{{ $requisition->status->status }}</span>
                        @endif
                    </td>
                    <td class="text-center">

                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <li>
                                        <a data-toggle="modal" data-keyboard="false" data-remote="{{ route('requisitions.show', array($requisition)) }}" href="#" class="dropdown-item" class="text-danger p-0" data-bs-toggle="modal" data-bs-target="#modal-large" title="Delete">Details</a>
                                    </li>
                                    <li>
                                        <a href="{!! route('requisitions.edit', array($requisition)) !!}" class="dropdown-item"
                                            data-toggle="modal" data-target="#fixedModal">Edit</a>
                                    </li>
                                    <li>
                                        <a wire:click="approve({{ $requisition }})" href="#" class="dropdown-item" data-target="#myModal" data-toggle="modal">Approve</a>
                                    </li>
                                    <li>
                                        <a wire:click="disapprove({{ $requisition }})" href="#" class="dropdown-item" data-target="#myModal" data-toggle="modal">Disapprove</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
