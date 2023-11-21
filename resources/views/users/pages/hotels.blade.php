@extends('layouts.app')

@section('content') 
<section id="establishments">
    <div class="container">
        <div class="row my-4">
          <div class="col-md-12">
            <h2 class="text-center">Hotels</h2>
          </div>
        </div>
        <div class="row my-6"> 
            <div class="col-md-12">
                @foreach ($establishments as $establishment)
                <br>
                <h4 class="px-2">{{ $establishment->name }}</h4>
                <p class="px-2 text-muted">{{ $establishment->location }}</p>

                <div class="row" id="dataContainer">
                   
                  @foreach ($establishment->rooms as $accommodation)
 

                  <div class="col-md-3 my-2" data-price="{{ $accommodation->price }}">

                      <div class="card p-2"> 
                          <div class="card-body">
                              <span class="badge badge-warning text-dark">{{ $accommodation->name }}</span>

                              @if ($accommodation->image_path)
                                <img class="img-rounded my-2 " style="object-fit: cover; max-width: 100%; min-height: 250px;" src="{{ asset($accommodation->image_path) }}" alt=""> 
                                @else

                                <img class="img-rounded my-2 " style="object-fit: cover; max-width: 100%; min-height: 250px;" src="{{ asset('/imgs/intro-logo.png') }}" alt=""> 
                              @endif
 
                              <div class="d-flex justify-content-between align-items-center">
                                <span> Capacity: {{$accommodation->capacity}} </span> <span> PHP{{ $accommodation->price }}</span>
                              </div>
 
                              <a class="btn btn-primary mt-2 mb-0" href="{{ route('user.establishment', $establishment->id) }}">View Details</a>
                          </div> 
                      </div>
                  </div>
                  @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section> 

@endsection
 