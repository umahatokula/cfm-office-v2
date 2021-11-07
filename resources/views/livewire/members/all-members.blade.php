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
                                <input wire:model="search" type="search" name="search" id="search" class="form-control mb-3" placeholder="Search...">
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form>
                                <select wire:change.prevent="filterByCenter($event.target.value)"  class="form-control mb-3">
                                    <option value="">Filter by Centre</option>
                                    @foreach ($churches as $church)
                                        <option value="{{ $church->id }}">{{ $church->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ route('members.create') }}" class="btn btn-primary btn-lg btn-md-block mb-3">Add member</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
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
                                        <th class="text-center">Name and Role</th>
                                        <th class="text-center">Church</th>
                                        <th class="text-left">Phone</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @foreach($members as $member)
                                    <tr>
                                        <td class="text-center"> {{ $loop->iteration }} </td>
                                        <td>
                                            {{$member->fname. ' '. $member->lname}}
                                        </td>
                                        <td class="text-left"> {{ $member->church ? $member->church->name : null }} </td>
                                        <td class="text-left"> {{$member->phone}} </td>
                                        <td class="text-center">
                                            <a href="{{ route('members.show', $member) }}" class="btn btn-primary btn-sm"> View Profile </a>
                                            <a href="{{ route('members.delete', $member) }}" class="btn btn-danger btn-sm"> Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="row my-5">
                                <div class="col-12 d-flex justify-content-center">
                                    {{ $members->links() }}
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
