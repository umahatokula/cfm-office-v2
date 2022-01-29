<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Create Salary Schedule</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <form wire:submit.prevent="save">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger alert-style-light" role="alert">
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        </div>
                        @endif

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" wire:model.lazy="name" id="name" class="form-control">
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input wire:model.lazy="status" value="1" class="form-check-input" type="checkbox" id="1"
                                        value="{{ old('status') }}" checked>
                                    <label class="form-check-label" for="1">Active</label>
                                </div>
                            </div>
                        </fieldset>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Schedule Elements</th>
                                            <th>Amoint</th>
                                            <th class="text-center">
                                                <a wire:click.prevent="addScheduleElement" href="#" class="text-white">
                                                    <span class="badge badge-primary">Add</span> 
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($scheduleElements as $key => $scheduleElement)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>
                                                <select wire:model.lazy="scheduleElements.{{$key}}.expense_head_id"
                                                    class="form-select form-control" required>
                                                    <option value="">Please select one</option>
                                                    @foreach ($salaryScheduleElements as $k => $salaryScheduleElement)
                                                        <option value="{{ $salaryScheduleElement->id }}">{{ $salaryScheduleElement->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="scheduleElements.{{$key}}.amount" required>
                                                @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                            </td>
                                            <td class="text-center">
                                                <a wire:click.prevent="removeScheduleElement({{ $key }})" href="#" class="text-danger p-0" data-original-title="" title="Delete">
                                                    <span class="material-icons-outlined">delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <p class="" colspan="5">No data</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <button type="cancel" class="btn btn-warning">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
