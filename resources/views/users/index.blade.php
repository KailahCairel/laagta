@extends('layouts.app')

@section('content')
<section id="custom-main" style="height: 100vh; background-repeat: no=repeat; background-image: url('{{asset('/imgs/manolofortich.jpg')}}')">
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
                                <div class="d-flex flex-wrap align-items-end justify-content-between"> 
                                  <div class="form-group col p-1 d-none">
                                      <label for="location">Where do you want to go?</label>
                                      <select class="form-control" name="location" id="location">

                                          @foreach ($destinations as $destination)

                                          <option value="{{ $destination->id }}"
                                                >
                                              {{ $destination->name }} </option>

                                          @endforeach

                                      </select>
                                  </div>

                                  <div class="form-group col p-1">
                                      <label for="categories">Services</label>
                                      <select class="form-control" name="categories" id="categories">
                                          <option value="accommodation">Accomodation</option>
                                          <option value="rides"
                                                >
                                              Activities</option> 
                                      </select>
                                  </div> 

                                  {{-- If accomodation is selected --}}
                                  <div class="col p-1 form-group" id="numberOfDaysCont">
                                      <label for="numberofdays">Length of Stay</label>
                                      <input type="text" class="form-control" name="dates"
                                          id="numberofdays" value=""
                                          required />

                                        <input type="hidden" class="form-control" name="numberofdays"  required />

                                  </div>


                                  <div class="col p-1 form-group">
                                      <label for="adults">Number of adults</label>
                                      <input type="number" min="0" class="form-control" name="adults"
                                          id="adults" value="" required />
                                  </div>
                                  <div class="col p-1 form-group">
                                      <label for="childs">Number of childrens</label>
                                      <input type="number" min="0" class="form-control" name="childs"
                                          id="childs" value="" required />
                                  </div> 
  
                                  <div class="col p-1 form-group">
                                      <label for="budget">Your budget?</label>
                                      <input type="number" min="0" class="form-control" name="budget"
                                          id="budget" value="" required />
                                  </div> 
                                  <div class="col p-1 form-group m-0">
                                    <button class="btn btn-primary w-100" type="submit">
                                        Submit
                                    </button>
                                  </div>
                                </div> 
                                

                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>


<div class="container my-6 py-3" id="user">
    
    <section id="establishments">
        <h2 class="text-center mb-1 font-weight-bold">Top Destinations in Manolo Fortich</h2>
        <div class="row">
            @foreach ($establishments->take(6) as $establishment)
                <div class="col-lg-2 col-sm-4 my-2">

                    <div class="card" style="background: transparent; box-shadow: unset;">
                        <div class="card-body text-center">
                            <a href="{{ route('user.establishment', $establishment->id) }}">

                                @if (count($establishment->images) > 0)
                                <div class="d-flex justify-content-center">
                                    <img style="border-radius: 100%; height: 150px; width: 150px; object-fit: cover;" src="{{ asset('storage/' . $establishment->images[0]->image_path) }}" alt="">
                                </div>
                                @endif

                                <h6>{{ Str::limit($establishment->name, 35) }}</h6>
    

                            </a>

                        </div> 
                    </div>


                </div>
            @endforeach
        </div>
    </section>
</div>
 
@endsection


@section('scripts')
<script src="{{ asset('/assets/js/plugins/swiper-bundle.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('/assets/js/jquery.min.js') }}" crossorigin="anonymous"></script>
 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

        $('input[name="dates"]').daterangepicker();

        $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
            // Calculate the number of days between the selected dates
            var startDate = picker.startDate;
            var endDate = picker.endDate;
            var numberOfDays = endDate.diff(startDate, 'days') + 1;

            // Insert the number of days into the hidden field
            $('input[name=numberofdays]').val(numberOfDays);
        });
    })

</script>

@endsection
