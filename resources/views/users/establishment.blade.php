@extends('layouts.app')

@section('content')
<div class="pt-5 pb-6 bg-cover" style="background-image: url('{{asset('/assets/img/header-blue-purple.jpg')}}')"></div>
<div class="container my-3 py-3">
     
    <div class="row">
        <div class="col-md-6">
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
        
        <div class="col-md-6"> 
            <div class="row">
                 
                        <h6 class="font-weight-semibold text-lg mb-0">Photos</h6>
                        <div class="position-relative overflow-hidden">
                            <div class="swiper mySwiper mt-4 mb-2" loop="true">
                                <div class="swiper-wrapper">
                                    @foreach ($establishment->images as $key => $image)
                                        
                                    <div class="swiper-slide">
                                        <div>
                                            <div
                                                class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                                <div class="full-background bg-contain"
                                                    style="background-image: url('{{ asset('storage/' . $image->image_path) }}')"></div>
                                                    <div class="card-body text-start px-3 py-0 w-100">
                                                    <div class="row mt-12">
                                                        
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
    <hr class="horizontal mb-4 dark">
    @if ($establishment->rooms->count())        
    <div class="row">
        <div class="col-md-4">
            <h6 class="text-sm font-weight-semibold mb-1">Rooms</h6>
            <p class="text-sm"> </p>
        </div>
        <div class="col-md-8 mb-6">
            <div class="card shadow-xs border mb-4">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="  py-3 px-4 text-sm"> 
                                    <span class="text-xs font-weight-semibold opacity-7 ms-1">Name</span>
                                </th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Capcity</th> 
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th> 
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($establishment->rooms as $room)
                            <tr>
                                <td class="py-3 px-4"> 
                                    <span class="font-weight-semibold text-dark ms-1">{{ $room->name }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge badge-sm border border-success text-success bg-success border-radius-sm">
                                         
                                        {{ $room->capacity }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm">PHP {{ $room->price }}</span>
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
    @if ($establishment->rides->count())        
    <div class="row">
        <div class="col-md-4">
            <h6 class="text-sm font-weight-semibold mb-1">Rides</h6>
            <p class="text-sm"> </p>
        </div>
        <div class="col-md-8 mb-6">
            <div class="card shadow-xs border mb-4">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="  py-3 px-4 text-sm"> 
                                    <span class="text-xs font-weight-semibold opacity-7 ms-1">Name</span>
                                </th> 
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th> 
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($establishment->rides as $ride)
                            <tr>
                                <td class="py-3 px-4"> 
                                    <span class="font-weight-semibold text-dark ms-1">{{ $ride->name }}</span>
                                </td> 
                                <td>
                                    <span class="text-sm">PHP {{ $ride->price }}</span>
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
    @if ($establishment->cottages->count())        
    <div class="row">
        <div class="col-md-4">
            <h6 class="text-sm font-weight-semibold mb-1">Cottages</h6>
            <p class="text-sm"> </p>
        </div>
        <div class="col-md-8 mb-6">
            <div class="card shadow-xs border mb-4">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="  py-3 px-4 text-sm"> 
                                    <span class="text-xs font-weight-semibold opacity-7 ms-1">Name</span>
                                </th> 
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th> 
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($establishment->cottages as $cottage)
                            <tr>
                                <td class="py-3 px-4"> 
                                    <span class="font-weight-semibold text-dark ms-1">{{ $cottage->name }}</span>
                                </td> 
                                <td>
                                    <span class="text-sm">PHP {{ $cottage->price }}</span>
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
  </script>
@endsection