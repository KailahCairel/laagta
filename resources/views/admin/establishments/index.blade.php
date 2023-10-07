@extends('layouts.app')

@section('content') 
   <div class="container-fluid py-4 px-5">
       
      <div class="row my-4"> 
        <div class="col-lg-12 col-md-6">
          <div class="card shadow-xs border">
            <div class="card-header border-bottom pb-0">
              <div class="d-sm-flex align-items-center mb-3">
                <div>
                  <h6 class="font-weight-semibold text-lg mb-0">Establishments</h6>
                  <p class="text-sm mb-sm-0 mb-2">List of all the available establishments</p>
                </div>
                <div class="ms-auto d-flex">
                  <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                    View report
                  </button>
                  <a href="{{ route('admin.establishments.create') }}" class="btn btn-sm btn-primary btn-icon d-flex align-items-center mb-0 gap-2">
                    <span class="btn-inner--icon">
                      +
                    </span>
                    <span class="btn-inner--text">Create</span>
                  </a>
                </div>
              </div>
              <div class="pb-3 d-sm-flex align-items-center">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                  <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable1" autocomplete="off" checked>
                  <label class="btn btn-white px-3 mb-0" for="btnradiotable1">All</label>
                  <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable2" autocomplete="off">
                  <label class="btn btn-white px-3 mb-0" for="btnradiotable2">Active</label>
                  <input type="radio" class="btn-check" name="btnradiotable" id="btnradiotable3" autocomplete="off">
                  <label class="btn btn-white px-3 mb-0" for="btnradiotable3">Inactive</label>
                </div>
                <div class="input-group w-sm-25 ms-auto">
                  <span class="input-group-text text-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                  </span>
                  <input type="text" class="form-control" placeholder="Search">
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
                      <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($establishments as $establishment)
                        
                    <tr>
                      <td>
                        <a href="{{ route('admin.establishments.show', $establishment->id) }}">
                        <div class="d-flex px-2">
                          <div class="avatar avatar-sm rounded-circle bg-gray-100 me-2 my-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M384 476.1L192 421.2V35.9L384 90.8V476.1zm32-1.2V88.4L543.1 37.5c15.8-6.3 32.9 5.3 32.9 22.3V394.6c0 9.8-6 18.6-15.1 22.3L416 474.8zM15.1 95.1L160 37.2V423.6L32.9 474.5C17.1 480.8 0 469.2 0 452.2V117.4c0-9.8 6-18.6 15.1-22.3z"/></svg>
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $establishment->name }}</h6>
                          </div>
                        </div>
                        </a>
                      </td>
                       
                      
                      <td class="align-middle">
                         {{ $establishment->location }}
                      </td>

                      <td class="align-middle">
                        <div class="d-flex gap-2">

                            <a href="{{ route('admin.establishments.edit', $establishment->id) }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" data-bs-title="Edit establishment">
                                <i class="fa fa-edit"></i>
                            </a>
                            
                            <a href="{{ route('admin.establishments.destroy', $establishment->id) }}" class="text-danger font-weight-bold text-xs" data-bs-toggle="tooltip" data-bs-title="Delete establishment" onclick="event.preventDefault(); document.getElementById('delete-destination-form-{{ $establishment->id }}').submit();">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form id="delete-destination-form-{{ $establishment->id }}" action="{{ route('admin.establishments.destroy', $establishment->id) }}" method="POST" style="display: none;">
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
