<div>

    <div class="row">
        <div class="col-md-12 text-end">
            <a wire:click.prevent="addRequisitionItem" href="#" class="text-white"><span
                    class="badge badge-primary">Add</span> </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        </div>
        <form wire:submit.prevent="save">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            @forelse ($requisitionItems as $key => $requisitionItem)
            <div class="row" style="margin-bottom: 25px">
                <div class="col-md-3 mb-4">
                    <div class="form-group">
                        <label class="form-label">Expense</label>
                        <select wire:model.lazy="requisitionItems.{{$key}}.expense_head_id"
                            class="form-select form-control" required>
                            <option value="">Please select one</option>
                            @foreach ($expenseHeads as $k => $expenseHead)
                            <option value="{{ $k }}">{{ $expenseHead }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" wire:model.lazy="requisitionItems.{{$key}}.description" required>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-1 mb-4">
                    <div class="form-group">
                        <label class="form-label">Qty</label>
                        <input type="number" class="form-control" wire:model.lazy="requisitionItems.{{$key}}.qty" required>
                        @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="form-group">
                        <label class="form-label">Unit Cost</label>
                        <input type="number" class="form-control" wire:model.lazy="requisitionItems.{{$key}}.unit_cost" required>
                        @error('unit_cost') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="form-group">
                        <label class="form-label">Total</label>
                        <input type="number" class="form-control"
                            wire:model.lazy="requisitionItems.{{$key}}.total_cost">
                        @error('total_cost') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-1 mb-4 pt-4 d-flex justify-content-end align-items-center">
                    <div class="form-group">
                        <a wire:click.prevent="removeRequisitionItem({{ $key }})" href="#" class="text-white">
                            <span class="badge badge-danger">Remove</span> </a>
                    </div>
                </div>
            </div>
            @empty
            <p class="" colspan="5">No data</p>
            @endforelse
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
