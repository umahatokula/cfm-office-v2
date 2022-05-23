<div>

    <div class="row">
        <div class="col-12">

            <form>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>

                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Transaction Type</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trxn_types as $type)
                        @php
                            $associated_trxns_dr = isset($type->dr_cr_codes['dr']) ? $type->dr_cr_codes['dr'] : null;
                            $associated_trxns_cr = isset($type->dr_cr_codes['cr']) ? $type->dr_cr_codes['cr'] : null;
                        @endphp
                        <tr>
                            <td>{{ $type->description }}</td>
                            <td>
                                <select wire:change="$set('dr', $event.target.value)" class="form-control select2">
                                    <option value="">Select one</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account['code'] }}" {{ $account['code'] == $associated_trxns_dr ? 'selected' : null}}>{{ $account['name'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select wire:change="$set('cr', $event.target.value)" class="form-control select2">
                                    <option value="">Select one</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account['code'] }}" {{ $account['code'] == $associated_trxns_cr ? 'selected' : null}}>{{ $account['name'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <a wire:click.prevent="accountLinked('{{$type->name}}')" class="btn btn-xs btn-primary" href="#">Link</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </form>

        </div>
    </div>

</div>
