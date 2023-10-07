@extends('layouts.app')



@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-md-flex align-items-center mb-3 mx-2">
                <div class="mb-md-0 mb-3">
                    <h3 class="font-weight-bold mb-0">{{ $establishment->name }}</h3>
                    <p class="mb-0">{{ $establishment->location }}</p>
                </div>
                <a href="{{ route('admin.establishments.edit', $establishment->id) }}"
                    class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                    <span class="btn-inner--text">Edit</span>
                </a>
                <button type="button" class="btn btn-sm btn-danger btn-icon d-flex align-items-center mb-0">
                    <span class="btn-inner--text">Delete</span>
                </button>
            </div>
        </div>
    </div>
    <hr class="my-0">
    <div class="row my-4">
        <div class="col-md-6">
            <div class="card shadow-xs border">
                <div class="card-body">
                    <h6 class="font-weight-semibold text-lg mb-0">Description</h6>
                    <div class="py-4">
                        {!! $establishment->description !!}
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="row">
                <div class="card shadow-xs border">
                    <div class="card-body">
                        <h6 class="font-weight-semibold text-lg mb-0">Photos</h6>
                        <div class="position-relative overflow-hidden">
                            <div class="swiper mySwiper mt-4 mb-2" loop="true">
                                <div class="swiper-wrapper">
                                    @foreach ($images as $key => $image)
                                        
                                    <div class="swiper-slide">
                                        <div>
                                            <div
                                                class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                                <div class="full-background bg-contain"
                                                    style="background-image: url('{{ asset('storage/' . $image->image_path) }}')"></div>
                                                <div class="card-body text-start px-3 py-0 w-100">
                                                    <div class="row mt-12">
                                                        <div class="col-sm-3 mt-auto">
                                                            <h4 class="text-dark font-weight-bolder">#{{ $key + 1 }}</h4>
                                                            
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    @endforeach

                                        
                                </div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
                
            </div> 
        </div>
    </div>
    
    <div class="row my-4">
        @if ($establishment->has_accomodation)
        <div class="col-lg-6 col-md-12 my-2">
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Rooms</h6>
                            <p class="text-sm mb-sm-0 mb-2">These are the list of all rooms.</p>
                        </div>
                        <div class="ms-auto d-flex"> 
                            <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0"
                                data-bs-toggle="modal" data-bs-target="#createRoomModal">
                                <span class="btn-inner--icon mx-2 d-flex align-items-center">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="btn-inner--text">New Room</span>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Room Name</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Capacity</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                <tr>
                                    <td>
                                        <div class="d-flex ">
                                            <div class="text-secondary text-xs font-weight-semibold opacity-7">
                                                {{ $room->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-semibold opacity-7">
                                        {{ $room->capacity }}</td>
                                    <td class="align-middle text-secondary text-xs font-weight-semibold opacity-7">
                                        {{ $room->price }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex alignt-items-center justify-content-center">

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editCottageModal"
                                                class="text-secondary font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Edit Room"
                                                data-bs-action="{{ route('admin.update.rooms', [$establishment->id, $room->id]) }}"
                                                data-bs-name="{{ $room->name }}"
                                                data-bs-description="{{ $room->description }}"
                                                data-bs-price="{{ $room->price }}"
                                                data-bs-capacity="{{ $room->capacity }}"
                                                data-room-name="{{ $room->name }}">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="#" class="text-danger font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Delete Room"
                                                onclick="event.preventDefault(); document.getElementById('delete-service-form-{{ $room->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>

                                        <form id="delete-service-form-{{ $room->id }}"
                                            action="{{ route('admin.delete.rooms', [$establishment->id, $room->id]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($establishment->has_rides)
        <div class="col-lg-6 col-md-12 my-2">
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Rides</h6>
                            <p class="text-sm mb-sm-0 mb-2">These are the list of all rides.</p>
                        </div>
                        <div class="ms-auto d-flex"> 
                            <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0"
                                data-bs-toggle="modal" data-bs-target="#createRideModal">
                                <span class="btn-inner--icon mx-2 d-flex align-items-center">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="btn-inner--text">New Ride</span>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Ride Name</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th> 
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($rides as $ride)
                                <tr>
                                    <td> 
                                        <div class="text-secondary text-xs font-weight-semibold">
                                            {{ $ride->name }}
                                        </div> 
                                    </td>
                                    <td> 
                                        <div class="text-secondary text-xs font-weight-semibold">
                                            {{ $ride->price }}
                                        </div> 
                                    </td> 
                                    <td class="align-middle">
                                        <div class="d-flex alignt-items-center justify-content-center">

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editrideModal"
                                                class="text-secondary font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Edit Ride"
                                                data-bs-action="{{ route('admin.update.rides', [$establishment->id, $ride->id]) }}"
                                                data-bs-name="{{ $ride->name }}"
                                                data-bs-description="{{ $ride->description }}"
                                                data-bs-price="{{ $ride->price }}"
                                                data-ride-name="{{ $ride->name }}">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="#" class="text-danger font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Delete Ride"
                                                onclick="event.preventDefault(); document.getElementById('delete-ride-form-{{ $ride->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>

                                        <form id="delete-ride-form-{{ $ride->id }}"
                                            action="{{ route('admin.delete.rides', [$establishment->id, $ride->id]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if ($establishment->has_venues)    
        <div class="col-lg-6 col-md-12 my-2">
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Cottages</h6>
                            <p class="text-sm mb-sm-0 mb-2">These are the list of all cottages.</p>
                        </div>
                        <div class="ms-auto d-flex"> 
                            <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0"
                                data-bs-toggle="modal" data-bs-target="#createCottageModal">
                                <span class="btn-inner--icon mx-2 d-flex align-items-center">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="btn-inner--text">New Cottage</span>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Cottage Name</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th> 
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 ps-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cottages as $cottage)
                                <tr>
                                    <td> 
                                        <div class="text-secondary text-xs font-weight-semibold">
                                            {{ $cottage->name }}
                                        </div> 
                                    </td>
                                    <td> 
                                        <div class="text-secondary text-xs font-weight-semibold">
                                            {{ $cottage->price }}
                                        </div> 
                                    </td> 
                                    <td class="align-middle">
                                        <div class="d-flex alignt-items-center justify-content-center">

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editCottageModal"
                                                class="text-secondary font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Edit cottage" 
                                                data-bs-action="{{ route('admin.update.rides', [$establishment->id, $ride->id]) }}"
                                                data-bs-name="{{ $cottage->name }}"
                                                data-bs-description="{{ $cottage->description }}"
                                                data-bs-price="{{ $cottage->price }}"
                                                data-cottage-name="{{ $cottage->name }}"> 
                                                
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="#" class="text-danger font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Delete cottage"
                                                onclick="event.preventDefault(); document.getElementById('delete-cottage-form-{{ $cottage->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>

                                        <form id="delete-cottage-form-{{ $cottage->id }}"
                                            action="{{ route('admin.delete.cottages', [$establishment->id, $cottage->id]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div> 
</div>


<!-- Modals -->
<!-- Add a new Rides -->
<div class="modal fade" id="createRideModal" tabindex="-1" role="dialog" aria-labelledby="createRideModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRideModal">Add Ride</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.store.rides', $establishment) }}" id="createService">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" id="name" required />
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex ms-auto justify-content-between gap-1">
                        <div class="col-auto form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required />
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('createService').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Rides --}}
<div class="modal fade" id="editrideModal" tabindex="-1" role="dialog" aria-labelledby="editrideModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editrideModal">Edit Ride</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="" id="editRide">

                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" id="name" required />
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex ms-auto justify-content-between gap-1">
                        <div class="col-auto form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required />
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('editRide').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Add a new room -->
<div class="modal fade" id="createRoomModal" tabindex="-1" role="dialog" aria-labelledby="createRoomModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoomModalTitle">Add Room</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.store.rooms', $establishment) }}" id="createRoom">
                    @csrf
                    <div class="form-group">
                        <label for="name">Room Name</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex ms-auto justify-content-between gap-1">
                        <div class="col-auto form-group">
                            <label for="name">Room Capacity</label>
                            <input type="number" class="form-control" name="capacity" id="capacity" required />
                        </div>
                        <div class="col-auto form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required />
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('createRoom').submit();">Save</button>
            </div>
        </div>
    </div>
</div>

<!--Edit room -->
<div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="editRoomModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoomModalTitle">Edit Room</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="" id="editRoom">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Room Name</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex ms-auto justify-content-between gap-1">
                        <div class="col-auto form-group">
                            <label for="name">Room Capacity</label>
                            <input type="number" class="form-control" name="capacity" id="capacity" required />
                        </div>
                        <div class="col-auto form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required />
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('editRoom').submit();">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Add a new Cottage -->
<div class="modal fade" id="createCottageModal" tabindex="-1" role="dialog" aria-labelledby="createCottageModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCottageModalTitle">Add Cottage</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.store.cottages', $establishment) }}" id="createCottage">
                    @csrf
                    <div class="form-group">
                        <label for="name">Cottage Name</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex ms-auto justify-content-between gap-1">
                        
                        <div class="col-auto form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required />
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('createCottage').submit();">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Cottage -->
<div class="modal fade" id="editCottageModal" tabindex="-1" role="dialog" aria-labelledby="editCottageModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCottageModalTitle">Edit Room</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="" id="editCottage">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Cottage Name</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex ms-auto justify-content-between gap-1">
                        <div class="col-auto form-group">
                            <label for="name">Cottage Capacity</label>
                            <input type="number" class="form-control" name="capacity" id="capacity" required />
                        </div>
                        <div class="col-auto form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required />
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('editCottage').submit();">Save</button>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script src="{{ asset('/assets/js/plugins/swiper-bundle.min.js') }}" crossorigin="anonymous"></script>
<script>
    if (document.getElementsByClassName('mySwiper')) {
        var swiper = new Swiper(".mySwiper", {
            effect: "fade",
            grabCursor: true,
            initialSlide: 0,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    };
     

    // Reusable function to set the form's action attribute
    function setFormActionInModal(modalId, formId) {
        var modal = document.querySelector(modalId);
        var form = document.querySelector(formId);

        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var action = button.getAttribute('data-bs-action'); // Get the value of data-bs-action attribute


            var name = button.getAttribute('data-bs-name');
            var description = button.getAttribute('data-bs-description');
            var price = button.getAttribute('data-bs-price');
            var capacity = button.getAttribute('data-bs-capacity');

            // Set the form's action attribute based on the data-bs-action value
            form.setAttribute('action', action);

            form.querySelector('[name="name"]').setAttribute('value', name);
            var textarea = form.querySelector('[name="description"]');
            textarea.value = description;
            form.querySelector('[name="price"]').setAttribute('value', price);
            form.querySelector('[name="capacity"]').setAttribute('value', capacity);
        });
    }

    // Call the function with your modal and form IDs
    setFormActionInModal('#editrideModal', '#editRide'); 
    setFormActionInModal('#editRoomModal', '#editRoom'); 
    setFormActionInModal('#editCottageModal', '#editCottage'); 

</script>
@endsection