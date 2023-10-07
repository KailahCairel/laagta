@extends('layouts.app')

@section('content')
<div class="py-4"></div>
<div class="px-5 py-4 container-fluid">
    <div class="my-4 row">
        <div class="col-12">
            <div class="card">
                <img src="../../assets/img/header-blue-purple.jpg" alt="pattern-lines"
                    class="top-0 rounded-2 position-absolute start-0 w-100 h-100">
                <div class="px-4 bg-cover card-body z-index-1">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <h3 class="text-white">{{ $user->name }}</h3>
                            <p class="mb-4 text-white">{{ $user->email }}</p> 
                        </div>
                        <div class="text-end col-lg-4 col-12">
                            <div class="border border-4 border-gray-100 avatar avatar-2xl rounded-circle position-relative mt-n7">
                                <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('imgs/default.png') }}" alt="Profile Image" class="w-100 h-100" id="profile">
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())

    @foreach ($errors->all() as $error)
    <div class="alert alert-danger text-sm" role="alert">
        <strong>Error!</strong> {{ $error }}
    </div>
    @endforeach
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="my-4 row">
        <div class="col-12 col-xl-4 mb-4">
            <div class="card border shadow-xs h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 col-9">
                            <h6 class="mb-0 font-weight-semibold text-lg">Profile information</h6>
                            <p class="text-sm mb-1">Edit the information about you.</p>
                        </div>
                        <div class="col-md-4 col-3 text-end">
                            <button type="button" class="btn btn-white btn-icon px-2 py-2" data-bs-toggle="modal"
                                data-bs-target="#editModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm mb-4">
                        {{ $user->description }}
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm"><span
                                class="text-secondary">Name:</span> &nbsp; {{ $user->name }}</li>
                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm"><span
                                class="text-secondary">Email:</span> &nbsp; {{ $user->email }}</li>
                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm"><span
                                class="text-secondary">Mobile:</span> &nbsp; {{ $user->phone }}</li>
                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm"><span
                                class="text-secondary">Function:</span> &nbsp; {{ $user->job }}</li>
                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm"><span
                                class="text-secondary">Location:</span> &nbsp; {{ $user->location }}</li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-4">
            <div class="card border shadow-xs h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 col-9">
                            <h6 class="mb-0 font-weight-semibold text-lg">Update Password</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('admin.profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group {{ $errors->has('current_password') ? 'has-danger' : 'has-success' }}">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password"
                                class="form-control {{ $errors->has('current_password') ? 'is-invalid' : 'is-valid' }}">

                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-danger' : 'has-success' }}">
                            <label for="new_password ">New Password</label>
                            <input type="password" name="new_password" id="new_password"
                                class="form-control {{ $errors->has('current_password') ? 'is-invalid' : 'is-valid' }}">
                        </div>

                        <div
                            class="form-group {{ $errors->has('new_password_confirmation') ? 'has-danger' : 'has-success' }}">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="form-control {{ $errors->has('current_password') ? 'is-invalid' : 'is-valid' }}">
                        </div>

                        <button type="submit" class="btn btn-dark">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 



{{-- Edit Form --}}
{{-- Trigger on the edit button on the profile card --}}

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"
                    id="profileUpdateForm">
                    @csrf
                    @method('PUT')
                    <!-- Use the PUT method for updates -->


                    <!-- Add input fields for other user data (phone, location, job, description, profile_image) -->
                    <div class="form-group ">
                        <label for="profile_image">Profile Picture</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control-file">
                    </div>

                    <div class="form-group {{ $errors->has('name') ? 'has-danger' : 'has-success' }}">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}" required>
                    </div>

                    <div class="form-group {{ $errors->has('phone') ? 'has-danger' : 'has-success' }}">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            class="form-control {{ $errors->has('phone') ? 'is-invalid' : 'is-valid' }}">
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-danger' : 'has-success' }}">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : 'is-valid' }}" required>
                    </div>

                    <div class="form-group {{ $errors->has('job') ? 'has-danger' : 'has-success' }}">
                        <label for="job">Job</label>
                        <input type="text" name="job" id="job" value="{{ old('job', $user->job) }}"
                            class="form-control {{ $errors->has('job') ? 'is-invalid' : 'is-valid' }}" required>
                    </div>

                    <div class="form-group {{ $errors->has('location') ? 'has-danger' : 'has-success' }}">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}"
                            class="form-control {{ $errors->has('location') ? 'is-invalid' : 'is-valid' }}" required>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-danger' : 'has-success' }}">
                        <label for="description">Tell us about yourself.</label>
                        <textarea class="form-control  {{ $errors->has('description') ? 'is-invalid' : 'is-valid' }}"
                            name="description" id="description" cols="30"
                            rows="10">{{ old('description', $user->description) }}</textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('profileUpdateForm').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
