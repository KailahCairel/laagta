@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-5">

    <div class="row my-4">
        <div class="col-lg-12 col-md-6">
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Users</h6>
                            <p class="text-sm mb-sm-0 mb-2">List of all the users</p>
                        </div>
                        <div class="ms-auto d-flex">  
                        </div>
                    </div> 
                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Member</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Location</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Phone</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Role</th> 
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex align-items-center">

                                                @if ($user->profile_image)
                                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="avatar avatar-sm rounded-circle me-2" id="profile">

                                                    @else
                                                    <img src="{{ asset('imgs/default.png') }}"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="user1">
                                                @endif

                                            </div>
                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $user->name }}</h6>
                                                <p class="text-sm text-secondary mb-0">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="align-middle">
                                        {{ $user->location }}
                                    </td>
                                    <td class="align-middle">
                                        {{ $user->phone }}
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm font-weight-bold text-capitalize">

                                            @if ($user->roles->count() > 0)
                                                {{ $user->roles[0]->name }}
                                            @else
                                                No Role Assigned
                                            @endif
                                        </span>
                                    </td> 


                                    <td class="align-middle"> 

                                        <a href="#" class="px-2 py-2 update-status" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-action="{{ route('admin.update-status', $user->id) }}" data-name="{{ $user->name }}">
                                             <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top py-3 px-3 d-flex align-items-center">
                        <p class="font-weight-semibold mb-0 text-dark text-sm">
                            Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                        </p>
                        <div class="ms-auto">
                            @if ($users->previousPageUrl())
                                <a href="{{ $users->previousPageUrl() }}" class="btn btn-sm btn-white mb-0">Previous</a>
                            @endif

                            @if ($users->nextPageUrl())
                                <a href="{{ $users->nextPageUrl() }}" class="btn btn-sm btn-white mb-0">Next</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Update Status --}} 
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit </h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="updateStatusForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="0">Deactivate</option>
                                <option value="1">Activate</option>
                            </select>
                        </div>
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('updateStatusForm').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Listen for radio button clicks
        $('input[type=radio][name=btnradiotable]').change(function () {
            var selectedStatus = $(this).data('status');
            console.log('Radio button changed'); // Add this line
            // Make an AJAX request to fetch users with the selected status
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.fetch-user') }}",
                data: { status: selectedStatus },
                success: function (response) {
                    // Update the user list on the page with the filtered data
                    $('#user-list').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
            
            // JavaScript code to update the form action URL    
        });

        // JavaScript code to update the form action URL
        $(document).ready(function() {
            $('.update-status').click(function() { 
                const action = $(this).data('action'); 
                const name = $(this).data('name'); 

                $('#updateStatusForm').attr('action', action);
                $('#editModalLabel').text('Edit ' + name);
                
 
            });
        });



    });
</script>


@endsection
