@extends('layouts.app')

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Edit New Coach</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">&nbsp</h5>
                        </div>
                        <div class="card-body">
                            {!! Form::model($lifeCoach, ['route' => ['life-coaches.update', $lifeCoach->id], 'method' => 'PUT', 'class' => 'row g-3']) !!}
                                @csrf
                                <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">First Name</label>
                                    {!! Form::text('fname', null, ['class' => 'form-control', 'id' => 'fname']) !!}
                                    @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">Last Name</label>
                                    {!! Form::text('lname', null, ['class' => 'form-control', 'id' => 'lname']) !!}
                                    @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) !!}
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12">
                                    <a class="btn btn-warning me-1" href="{{ url()->previous() }}">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
