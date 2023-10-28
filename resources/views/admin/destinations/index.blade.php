@extends('layouts.app')

@section('content') 
   <div class="container-fluid py-4 px-5">
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
      <div class="row my-4"> 
        <div class="col-lg-12 col-md-6">
          <div class="card shadow-xs border">
            <div class="card-header border-bottom pb-0">
              <div class="d-sm-flex align-items-center mb-3">
                <div>
                  <h6 class="font-weight-semibold text-lg mb-0">Destinations</h6>
                  <p class="text-sm mb-sm-0 mb-2">List of all the available destinations</p>
                </div>
                <div class="ms-auto d-flex"> 
                  <a href="{{ route('admin.destinations.create') }}" class="btn btn-sm btn-primary btn-icon d-flex align-items-center mb-0 gap-2">
                    <span class="btn-inner--icon">
                      +
                    </span>
                    <span class="btn-inner--text">Create</span>
                  </a>
                </div>
              </div>
               
            </div>
            <div class="card-body px-0 py-0">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead class="bg-gray-100">
                    <tr>
                      <th class="text-secondary text-xs font-weight-semibold opacity-7">Name</th>
                      <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Location</th> 
                      <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th> 
                      <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($destinations as $destination)
                        
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div class="avatar avatar-sm rounded-circle bg-gray-100 me-2 my-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M384 476.1L192 421.2V35.9L384 90.8V476.1zm32-1.2V88.4L543.1 37.5c15.8-6.3 32.9 5.3 32.9 22.3V394.6c0 9.8-6 18.6-15.1 22.3L416 474.8zM15.1 95.1L160 37.2V423.6L32.9 474.5C17.1 480.8 0 469.2 0 452.2V117.4c0-9.8 6-18.6 15.1-22.3z"/></svg>
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $destination->name }}</h6>
                          </div>
                        </div>
                      </td>
                       
                      
                      <td class="align-middle">
                         {{ $destination->location }}
                      </td>

                      <td class="align-middle">
                          @if ($destination->status)
                              <span class="badge badge-sm border border-success text-success bg-success">Active</span>
                          @else
                              <span class="badge badge-sm border border-danger text-danger bg-danger">Inactive</span>
                          @endif
                      </td>

                      <td class="align-middle">
                        <div class="d-flex gap-2">

                          <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" data-bs-title="Edit user">
                            <i class="fa fa-edit"></i>
                          </a>
                          
                          <a href="{{ route('admin.destinations.destroy', $destination->id) }}" class="text-danger font-weight-bold text-xs" data-bs-toggle="tooltip" data-bs-title="Delete destination" onclick="event.preventDefault(); document.getElementById('delete-destination-form-{{ $destination->id }}').submit();">
                            <i class="fa fa-trash"></i>
                          </a>
                          <form id="delete-destination-form-{{ $destination->id }}" action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                          </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div> 
       {{-- Footer --}}
    </div>


    
@endsection
