<div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12" id="errorMsg">
                        </div>
                    </div>

                    {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger alert-style-light" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                        @endforeach
                    </div>
                    @endif --}}

                    <form wire:submit.prevent="save">

                        <div class="row mb-3">
                            <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                            <div class="col-sm-10">
                                <input wire:model="fname" type="text" class="form-control" id="fname">
                                @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-10">
                                <input wire:model="lname" type="text" class="form-control" id="lname">
                                @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender_id" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <select wire:model="gender_id" class="form-control mb-3">
                                    <option value="">Select one...</option>
                                    @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                                @error('gender_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input wire:model="email" type="email" class="form-control" id="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input wire:model="phone" type="number" class="form-control" id="phone">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country_id" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <select wire:model="country_id" class="form-control mb-3">
                                    <option value="">Select one...</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state_id" class="col-sm-2 col-form-label">State</label>
                            <div class="col-sm-10">
                                <select wire:model="state_id" class="form-control mb-3">
                                    <option value="">Select one...</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                @error('state_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="local_id" class="col-sm-2 col-form-label">LGA</label>
                            <div class="col-sm-10">
                                <select wire:model="local_id" class="form-control mb-3">
                                    <option value="">Select one...</option>
                                    @foreach ($locals as $local)
                                    <option value="{{ $local->id }}">{{ $local->name }}</option>
                                    @endforeach
                                </select>
                                @error('local_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Date of birth</label>
                            <div class="col-sm-3 mb-1">
                                <select wire:model="day" class="form-control mb-3">
                                    <option value="">Day</option>
                                    @foreach (range(1,31) as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('day') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-sm-3 mb-1">
                                <select wire:model="month" class="form-control mb-3">
                                    <option value="">Month</option>
                                    @foreach (range(1,12) as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                @error('month') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-sm-3 mb-1">
                                <input wire:model="year" type="text" class="form-control" id="year" placeholder="Year">
                                @error('year') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="church_id" class="col-sm-2 col-form-label">Church</label>
                            <div class="col-sm-10">
                                <select wire:model="church_id" class="form-control mb-3">
                                    <option value="">Select one...</option>
                                    @foreach ($churches as $church)
                                    <option value="{{ $church->id }}">{{ $church->name }}</option>
                                    @endforeach
                                </select>
                                @error('church_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea wire:model="address" type="text" class="form-control" id="address"></textarea>
                                @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="picture" class="col-sm-2 col-form-label">Upload picture</label>
                            <div class="col-sm-10">
                                <input wire:model="picture" type="file" class="form-control" id="picture">
                                @error('picture') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input wire:model="facebook" type="text" class="form-control" id="facebook">
                                @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                            <div class="col-sm-10">
                                <input wire:model="whatsapp" type="text" class="form-control" id="whatsapp">
                                @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                            <div class="col-sm-10">
                                <input wire:model="twitter" type="text" class="form-control" id="twitter">
                                @error('twitter') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input wire:model="instagram" type="text" class="form-control" id="instagram">
                                @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="cancel" class="btn btn-warning">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>

                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
