<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Members</h1>
                        <span>CFC Members. Can be filtered by center</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        &nbsp
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <form>
                                <input wire:model="search" type="search" name="search" id="search"
                                    class="form-control mb-3" placeholder="Search...">
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form>
                                <select wire:change.prevent="filterByCenter($event.target.value)"
                                    class="form-control mb-3">
                                    <option value="">Filter by Centre</option>
                                    @foreach ($churches as $church)
                                    <option value="{{ $church->id }}">{{ $church->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('members.create') }}" class="btn btn-success">Add member</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    @if (count($errors) > 0)
                    <div class="alert alert-danger alert-style-light" role="alert">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                        @endforeach
                    </div>
                    @endif

                    <div>
                        @if (session()->has('message'))
                        <div class="alert alert-success alert-style-light" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                    </div>

                    <div class="example-container">
                        <div class="example-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-start">Name and Role</th>
                                        <th class="text-start">Church</th>
                                        <th class="text-start">Phone</th>
                                        <th class="text-start">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($members as $member)
                                    <tr>
                                        <td class="text-center"> {{ $loop->iteration }} </td>
                                        <td>
                                            {{$member->fname. ' '. $member->lname}}
                                        </td>
                                        <td class="text-left"> {{ $member->church ? $member->church->name : null }}
                                        </td>
                                        <td class="text-left"> {{$member->phone}} </td>
                                        <td class="text-center">

                                            <a href="{{ route('members.show', $member) }}" class="text-primary p-0"
                                                data-original-title="" title="Details">
                                                <span class="material-icons-outlined">visibility</span>
                                            </a>

                                            <a href="{{ route('members.edit', $member)}}" class="text-success p-0"
                                                data-original-title="" title="Delete">
                                                <span class="material-icons-outlined">edit</span>
                                            </a>

                                            <a data-bs-toggle="modal" data-bs-target="#modal-large" data-toggle="modal" data-keyboard="false" data-remote="{{ route('members.notify', $member) }}" href="#" class="text-dark p-0" title="SMS">
                                                <span class="material-icons-outlined">sms</span>
                                            </a>

                                            <a wire:click.prevent="destroy({{ $member->id }})"
                                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                href="#" class="text-danger p-0" data-original-title="" title="Delete">
                                                <span class="material-icons-outlined">delete</span>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <div class="pt-2">
                                        <p class="mb-sm-0">Showing {{ $members->currentPage() }} to {{ $members->perPage() }} of {{ $members->total() }} entries</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-sm-end">
                                        {{ $members->appends(request()->input())->links() }}
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
