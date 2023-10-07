@extends('layouts.app')

@section('content')
<div class="px-5 py-4 container-fluid">
    <div class="row">
        <div class="mx-auto col-lg-9 col-12">
            <div class="mt-4 card blur">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.establishments.update', $establishment) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h6 class="mb-0">Update Establishment</h6>
                        <p class="mb-4 text-sm">Update {{ $establishment->name }}</p>


                        <div class="form-group {{ $errors->has('name') ? 'has-danger' : 'has-success' }}">
                            <label for="name" class="form-label">Establishment Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name"  onfocus="focused(this)"
                            onfocusout="defocused(this)" value="{{ old('name', $establishment->name) }}">
                        </div>

                        <div class="form-group {{ $errors->has('destination_id') ? 'has-danger' : 'has-success' }}">
                            <label for="destination_id">Select Destination</label>
                            <select name="destination_id" id="destination_id" class="form-control {{ $errors->has('destination_id') ? 'is-invalid' : 'is-valid' }}">
                                <option value="" disabled selected>Select a destination</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}" {{ $establishment->destination_id == $destination->id ? 
                                    'selected':'' }} >{{ $destination->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <h5 for="">Contact Info</h5>
                        <div class="d-flex gap-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="mt-4 form-label">Email</label>    
                                    <input class="form-control" type="text" name="email" value="{{ old('email', $establishment->email) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="mt-4 form-label">Phone</label>    
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone', $establishment->phone) }}">
                                </div>
                            </div>
                        </div>

                        <h5>Entrance Fee</h5>
                        <div class="d-flex gap-2">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="mt-4 form-label">Adult</label>    
                                    <input class="form-control" type="text" name="entrance_fee_adult" value="{{ old('entrance_fee_adult', $establishment->entrance_fee_adult) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="mt-4 form-label">Child</label>    
                                    <input class="form-control" type="text" name="entrance_fee_child" value="{{ old('entrance_fee_child', $establishment->entrance_fee_child) }}">
                                </div>
                            </div>
                        </div>




                        <div class="mt-4 row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Status
                                    </label>
                                    <p class="text-xs form-text text-muted ms-1">
                                        Set to yes if you want the location to appear in the front end.
                                    </p>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            onclick="notify(this)" data-type="warning"
                                            data-content="Once a project is made private, you cannot revert it to a public project."
                                            data-title="Warning" data-icon="ni ni-bell-55" {{ $destination->status ? 'checked':'' }}>
                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Venues
                                    </label>
                                    <p class="text-xs form-text text-muted ms-1">
                                        Set to yes if this establishment has venues.
                                    </p>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            onclick="notify(this)" data-type="warning"
                                            data-content="Once a project is made private, you cannot revert it to a public project."
                                            data-title="Warning" data-icon="ni ni-bell-55" {{ $destination->venues ? 'checked':'' }}
                                            name="venues">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Accomodation
                                    </label>
                                    <p class="text-xs form-text text-muted ms-1">
                                        Set to yes if this establishment has accomodations.
                                    </p>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            onclick="notify(this)" data-type="warning"
                                            data-content="Once a project is made private, you cannot revert it to a public project."
                                            data-title="Warning" data-icon="ni ni-bell-55" {{ $destination->accomodation ? 'checked':'' }}
                                            name="accomodation">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Rides
                                    </label>
                                    <p class="text-xs form-text text-muted ms-1">
                                        Set to yes if this establishment has rides.
                                    </p>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            onclick="notify(this)" data-type="warning"
                                            data-content="Once a project is made private, you cannot revert it to a public project."
                                            data-title="Warning" data-icon="ni ni-bell-55" {{ $destination->rides ? 'checked':'' }}
                                            name="rides">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="d-flex flex-wrap align-items-stretch">
                                @foreach ($images as $key => $image)
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail h-100" alt="">
                                    </div>
                                @endforeach
                            </div>

                            <label class="mt-4">Upload Images</label>
                            <p class="form-text text-muted text-xs ms-1">
                                Upload images for them to visually figure out what is the actual place.
                            </p>
                            <input type="file" name="images[]" multiple accept="image/*" class="form-control">
                        </div>

                        <div class="form-group">

                            <label class="mt-4">Establishment Description</label>
                            <p class="form-text text-muted text-xs ms-1">
                                This is how others will learn about the establishment, so make it good!
                            </p>
                            <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ old('description', $establishment->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="mt-4 form-label">Location</label>    
                            <input class="form-control" type="text" name="location" value="{{ old('location', $establishment->location) }}">
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <a href="{{ route('admin.establishments.index') }}" name="button" class="m-0 btn btn-white">Cancel</a>
                            <button type="submit" name="button" class="m-0 btn btn-dark ms-2">Update establishment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
