<div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">&nbsp;</h5>
                        </div>
                        <div class="card-body">

                            <form wire:submit.prevent="save">

                                <div class="row mb-3">
                                    <label for="staff_name" class="col-sm-2 col-form-label"><b>Staff</b> </label>
                                    {{-- <div class="col-sm-10"> --}}
                                    <input type="text" wire:model.defer="staff_name" class="form-control" id="staff_name" disabled>
                                    <input type="hidden" wire:model.defer="staff_id">
                                    {{-- </div> --}}
                                </div>


                                <div class="row mb-3">
                                    <label for="bank_id" class="col-sm-2 col-form-label"><b>Bank</b> </label>
                                    {{-- <div class="col-sm-10"> --}}
                                    <select wire:model.defer="bank_id" id="bank_id" class="form-control">
                                        <option value="">Select bank</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bank_id') <small class="text-danger">{{$message}}</small> @enderror
                                    {{-- </div> --}}
                                </div>


                                <div class="row mb-3">
                                    <label for="account_number" class="col-sm-12 col-form-label"><b>Account number</b> </label>
                                    {{-- <div class="col-sm-10"> --}}
                                    <input type="number" wire:model.defer="account_number" id="account_number" class="form-control">
                                    @error('account_number') <small class="text-danger">{{$message}}</small> @enderror
                                    {{-- </div> --}}
                                </div>


                                <div class="row mb-3">
                                    <label for="account_name" class="col-sm-12 col-form-label"><b>Account name</b> </label>
                                    {{-- <div class="col-sm-10"> --}}
                                    <input type="text" wire:model.defer="account_name" id="account_name" class="form-control">
                                    @error('account_name') <small class="text-danger">{{$message}}</small> @enderror
                                    {{-- </div> --}}
                                </div>


                                <div class="form-check form-switch mb-3">
                                    {!! Form::label('is_primary', 'Make this primary account', array('class' =>
                                    'form-check-label', 'for' => 'is_primary')) !!}
                                    <input wire:model.defer="is_primary" class="form-check-input" type="checkbox" id="is_primary" checked>
                                    @error('is_primary') <small class="text-danger">{{$message}}</small> @enderror
                                </div>


                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <a href="{{ route('church-services.index') }}" class="btn btn-danger">Cancel</a>
                                        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
