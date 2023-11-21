@extends('layouts.app')

@section('content')
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
    @foreach ($establishment->images as $key => $image)
    <div class="swiper-slide">
    <div class="pt-5 pb-6 bg-cover bg-cover-custom" style="background-image: url('{{asset('storage/' . $image->image_path)}}')"></div>
    </div>
    @endforeach
    <div class="swiper-nav swiper-button-prev">
        <i class="fa fa-chevron-left"></i>
    </div>
    <div class="swiper-nav swiper-button-next">
        <i class="fa fa-chevron-right"></i>
    </div>
    </div>
</div>


<div class="container my-3 py-3">
     
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex align-items-center mb-4">
                <h3 class="mb-1 font-weight-bold">
                    {{ $establishment->name }}
                </h3>
            </div>
            <div class="d-md-flex align-items-center mb-4">
                <div class="mb-md-0 mb-3">
                    <h5 class="font-weight-semibold mb-1">About</h5>
                    <p class="text-sm mb-0">{{ $establishment->description }}</p>
                </div>
                 
            </div>
        </div>
         
    </div>
    @if ($establishment->rooms->count())   
        <h4>Rooms</h4>     
        <hr class="horizontal mb-4 dark">
        <div class="row my-2">

            @foreach ($establishment->rooms as $room)
                 <div class="col-md-3 my-2" data-price="{{ $room->price }}">

                      <div class="card p-2"> 
                          <div class="card-body">
                              
                              @if ($room->image_path)
                              <img class="img-rounded mb-2" style="border-radius: 10px; object-fit: cover; width: 100%; min-height: 250px" src="{{ asset($room->image_path) }}" alt=""> 
                              @else
                              
                              <img class="img-rounded mb-2" style="border-radius: 10px; object-fit: cover; width: 100%; min-height: 250px" src="{{ asset('/imgs/intro-logo.png') }}" alt=""> 
                              @endif 
                              <h6>{{ $room->name }}</h6>
                              <div class="d-flex justify-content-between align-items-center">
                                <span> Capacity: <strong>{{$room->capacity}}</strong> </span> 
                                <span class="badge badge-success"> {{ $room->price }}</span>
                              </div> 
                          </div> 
                      </div>
                  </div>
            @endforeach

        </div>
    @endif 
    <br>
    @if ($establishment->rides->count())   
        <h4>Activities</h4>     
        <hr class="horizontal mb-4 dark">
        <div class="row my-2">

            @foreach ($establishment->rides as $rides)
                 <div class="col-md-3 my-2" data-price="{{ $rides->price }}">

                      <div class="card p-2"> 
                          <div class="card-body">
                              
                              @if ($rides->image_path)
                              <img class="img-rounded mb-2" style="border-radius: 10px; object-fit: cover; width: 100%; min-height: 250px" src="{{ asset($rides->image_path) }}" alt=""> 
                              @else
                              
                              <img class="img-rounded mb-2" style="border-radius: 10px; object-fit: cover; width: 100%; min-height: 250px" src="{{ asset('/imgs/intro-logo.png') }}" alt=""> 
                              @endif
                              
                              <h6 class="">{{ $rides->name }}</h6>
                              
                              <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-success"> PHP{{ $rides->price }}</span>
                              </div> 
                          </div> 
                      </div>
                  </div>
            @endforeach

        </div>
    @endif   
     
</div>

<div class="map">
    {!! $establishment->maps !!}
</div>

@endsection


@section('scripts')
<script src="{{ asset('/assets/js/plugins/swiper-bundle.min.js') }}" crossorigin="anonymous"></script>
<script>
    if (document.getElementsByClassName('mySwiper').length > 0) {
        var swiper = new Swiper(".mySwiper", {
            effect: "fade",
            grabCursor: true,
            initialSlide: 0,
            autoplay: {
                delay: 5000, // Set the autoplay delay in milliseconds
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

  </script>
@endsection