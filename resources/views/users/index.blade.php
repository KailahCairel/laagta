@extends('layouts.app')

@section('content')
<section style="height: 100vh; background-image: url('{{asset('/imgs/manolofortich.jpg')}}')">
    <div class="container h-100">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <div class="content w-100">
                <div class="col-md-12">
                    <h1 class="text-light text-bold">Destinations for you</h1>
                    <p class="text-light">We make it easy to find the perect destination.</p>
                </div>
                <div class="col-md-12"> 
                    <div class="card" style="background: rgb(197 197 197 / 80%);"> 
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.process-form') }}"
                                id="createService">
                                @csrf 
                                <div class="d-flex flex-wrap"> 
                                  <div class="form-group col-md-2 p-1">
                                      <label for="location">Where do you want to go?</label>
                                      <select class="form-control" name="location" id="location">

                                          @foreach ($destinations as $destination)

                                          <option value="{{ $destination->id }}"
                                                >
                                              {{ $destination->name }} </option>

                                          @endforeach

                                      </select>
                                  </div>

                                  <div class="form-group col-md-2 p-1">
                                      <label for="categories">Services</label>
                                      <select class="form-control" name="categories" id="categories">
                                          <option value="accommodation">Accomodation</option>
                                          <option value="rides"
                                                >
                                              Rides</option>
                                          <option value="venue"
                                                >
                                              Venue</option>
                                      </select>
                                  </div> 

                                  {{-- If accomodation is selected --}}
                                  <div class="col-md-2 p-1 form-group" id="numberOfDaysCont">
                                      <label for="numberofdays">Length of Stay</label>
                                      <input type="number" class="form-control" name="numberofdays"
                                          id="numberofdays" value=""
                                          required />
                                  </div>


                                  <div class="col-md-2 p-1 form-group">
                                      <label for="adults">Number of adults</label>
                                      <input type="number" class="form-control" name="adults"
                                          id="adults" value="" required />
                                  </div>
                                  <div class="col-md-2 p-1 form-group">
                                      <label for="childs">Number of childrens</label>
                                      <input type="number" class="form-control" name="childs"
                                          id="childs" value="" required />
                                  </div> 
  
                                  <div class="col-md-2 p-1 form-group">
                                      <label for="budget">What is your budget?</label>
                                      <input type="number" class="form-control" name="budget"
                                          id="budget" value="" required />
                                  </div> 
                                </div> 
                                
                                <div class="col-md-12 p-1 form-group m-0">
                                  <button class="btn btn-primary w-100" type="submit">
                                      Submit
                                  </button>
                                </div>

                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>


<div class="container my-3 py-3" id="user">
    <section id="destinations">
        <div class="row">
            @foreach ($destinations as $destination)
            <div class="col-lg-3 col-sm-6 cursor-pointer" data-id="{{ $destination->id }}">
                <div class="card blur border border-white mb-4 shadow-xs">
                    <div class="card-body p-4">
                        <div
                            class="icon icon-shape bg-white shadow shadow-xs text-center border-radius-md row align-items-center justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="19" width="19" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M11.584 2.376a.75.75 0 01.832 0l9 6a.75.75 0 11-.832 1.248L12 3.901 3.416 9.624a.75.75 0 01-.832-1.248l9-6z" />
                                <path fill-rule="evenodd"
                                    d="M20.25 10.332v9.918H21a.75.75 0 010 1.5H3a.75.75 0 010-1.5h.75v-9.918a.75.75 0 01.634-.74A49.109 49.109 0 0112 9c2.59 0 5.134.202 7.616.592a.75.75 0 01.634.74zm-7.5 2.418a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75zm3-.75a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0v-6.75a.75.75 0 01.75-.75zM9 12.75a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75z"
                                    clip-rule="evenodd" />
                                <path d="M12 7.875a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" />
                            </svg>
                        </div>
                        <p class="text-sm mb-1">{{ $destination->name }}</p>
                        <h3 class="mb-0 font-weight-bold">{{  $destination->establishments->count() }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <section id="establishments">
        <div class="row mb-6">
            @foreach ($establishments as $establishment)
            <div class="col-lg-4 col-sm-6 my-2">

                <div class="card">
                    <div class="card-body">

                        @if (count($establishment->images) > 0)
                        <img src="{{ asset('storage/' . $establishment->images[0]->image_path) }}" alt="">
                        @endif

                        <h4>{{ $establishment->name }}</h4>
                        <p>{{ Str::limit($establishment->description, 150) }}</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="{{ route('user.establishment', $establishment->id) }}">View
                            Details</a>
                    </div>
                </div>


            </div>
            @endforeach
        </div>
    </section>
</div>

{{-- <button class="btn btn-primary row align-items-center" id="find-establishments" data-bs-toggle="modal" data-bs-target="#findEstablishment"> 
      <i class="fa fa-chevron-left"></i>
      <span>
        Find Establishment 
      </span>
    </button> --}}

<div class="modal fade" id="findEstablishment" tabindex="-1" role="dialog" aria-labelledby="findEstablishment"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="findEstablishment">Find Establishment</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('user.process-form') }}" id="createService">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="location">Where do you want to go?</label>
                            <select class="form-control" name="location" id="location">

                                @foreach ($destinations as $destination)

                                <option value="{{ $destination->id }}"> {{ $destination->name }} </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="categories">Services</label>
                            <select class="form-control" name="categories" id="categories">
                                <option value="accommodation">Accomodation</option>
                                <option value="rides">Rides</option>
                                <option value="venue">Venue</option>
                            </select>
                        </div>
                    </div>

                    {{-- If accomodation is selected --}}
                    <div class="col-auto form-group" id="numberOfDaysCont">
                        <label for="numberofdays">Length of Stay</label>
                        <input type="number" class="form-control" name="numberofdays" id="numberofdays" required />
                    </div>


                    <div class="row ms-auto justify-content-between">
                        <div class="col-auto form-group">
                            <label for="adults">Number of adults</label>
                            <input type="number" class="form-control" name="adults" id="adults" value="0" required />
                        </div>
                        <div class="col-auto form-group">
                            <label for="childs">Number of childrens</label>
                            <input type="number" class="form-control" name="childs" id="childs" value="0" required />
                        </div>
                    </div>

                    <div class="row ms-auto justify-content-between">
                        <div class="col-auto form-group">
                            <label for="budget">What is your budget?</label>
                            <input type="number" class="form-control" name="budget" id="budget" required />
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
@endsection


@section('scripts')
<script src="{{ asset('/assets/js/plugins/swiper-bundle.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('/assets/js/jquery.min.js') }}" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $("#categories").on('change', function () {
            selected = $(this).val()


            console.log(selected);

            if (selected === "accommodation") {
                $("#numberOfDaysCont").show();
            } else {
                $("#numberOfDaysCont").hide();
                $("#numberofdays").val(0);

            }
        })
    })

</script>

@endsection
