@extends('layouts.app')

@section('content')
<div class="px-5 py-4 container-fluid">
    <div class="row">
        <div class="mx-auto col-lg-9 col-12">
            <div class="mt-4 card blur">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}">
                        @csrf
                        @method('PUT')
                        <h6 class="mb-0">Update Destination</h6>

                        <div class="form-group {{ $errors->has('name') ? 'has-danger' : 'has-success' }}">
                            <label for="name" class="form-label">Destination Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" value="{{ $destination->name }}"  onfocus="focused(this)"
                            onfocusout="defocused(this)">
                        </div>

                        <div class="mt-4 row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <p class="text-xs form-text text-muted ms-1">
                                        Toggle to switch on and off status
                                    </p>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" {{ $destination->status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="mt-4">Destination Description</label>
                            <p class="form-text text-muted text-xs ms-1">
                                This is how others will learn about the destination, so make it good!
                            </p>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ $destination->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="mt-4 form-label">Location</label>    
                            <input class="form-control" type="text" name="location" value="{{ $destination->location }}">
                        </div>


                         

                        <div class="mt-4 d-flex justify-content-end">
                            <a href="{{ route('admin.destinations.index') }}" name="button" class="m-0 btn btn-white">Cancel</a>
                            <button type="submit" name="button" class="m-0 btn btn-dark ms-2">Update Destination</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
