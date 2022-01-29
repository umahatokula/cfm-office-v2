@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col">
        <div class="page-description">
            <div class="row">
                <div class="col-md-12">
                    <h1>Create Salary Schedule Element</h1>
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

                {!! Form::open(['route' => 'salaries-schedule-elements.store']) !!}
                
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input name="status" value="1" class="form-check-input" type="checkbox" id="1" value="{{ old('status') }}" checked>
                                <label class="form-check-label" for="1">Active</label>
                            </div>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </fieldset>

                    <button type="cancel" class="btn btn-warning">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
