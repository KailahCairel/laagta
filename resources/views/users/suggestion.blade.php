@extends('layouts.app')

@section('content')
{{-- @include('users.inc.findEstablishments') --}}


{{-- <div class="container my-3 py-3" id="user">   
     
    <section id="establishments">
      
      <div class="row mb-6" > 
        @foreach ($establishments as $establishment)
          @php
              $totalPersons = $adults + $children;
              $totalRidesPrice = 0;
              $totalEntranceFeeAdult = $adults * $establishment->entrance_fee_adult;
              $totalEntranceFeeChild = $children * $establishment->entrance_fee_child;


              $totalEntranceFee = $totalEntranceFeeAdult + $totalEntranceFeeChild;

              if ($categories == 'accommodation') { 
                  $counter = 0;

                  foreach ($establishment->rooms as $accommodation): 
                    $price = $accommodation->price;
                    $budget = $budget;

                    if(($accommodation->price * $numberofdays) + $totalEntranceFee >= $budget) {
                      continue;
                    }

                    if($totalPersons > $accommodation->capacity) {
                      continue;
                    }

                    $counter++; 

                  endforeach;

                  if ($counter == 0) {

                    continue;
                  }
              }
          @endphp
          
          <div class="col-lg-4 col-sm-6 my-2">
    
            <div class="card"> 
              <div class="card-header py-0"> <h4>{{ $establishment->name }}</h4>
</div>
<div class="card-body">

    @if (count($establishment->images) > 0)
    <img src="{{ asset('storage/' . $establishment->images[0]->image_path) }}" alt="">
    @endif

    <h4>{{ $establishment->name }}</h4>

    <p>{{ Str::limit($establishment->description, 150) }}</p>
</div>
<div class="card-footer">
    <button class="btn btn-primary view-details" data-bs-toggle="modal"
        data-bs-target="#detailsModal{{ $establishment->id }}">View Details</button>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailsModal{{ $establishment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel"><span class="text-uppercase">{{ $categories }}</span> -
                    {{ $establishment->name }}</h5>
                <a type="button" class="close font-2x" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <!-- Place the 'foreach' loop here to display details inside the modal -->
                @php
                $totalPersons = $adults + $children;
                $totalRidesPrice = 0;
                $totalEntranceFeeAdult = $adults * $establishment->entrance_fee_adult;
                $totalEntranceFeeChild = $children * $establishment->entrance_fee_child;


                $totalEntranceFee = $totalEntranceFeeAdult + $totalEntranceFeeChild;
                @endphp

                @if ($categories == 'rides')
                <div class="d-flex flex-column">
                    @foreach ($establishment->rides as $ride)
                    @php
                    $price = $ride->price;
                    $pricePerPerson = $totalPersons * $price;
                    $formattedPricePerPerson = number_format($pricePerPerson, 2); // Format to 2 decimal places
                    $totalRidesPrice += $pricePerPerson;
                    @endphp
                    <div class="card my-2">
                        <div class="card-body">
                            <p>Name: <strong>{{ $ride->name }}</strong></p>
                            <p>Price per Person: <strong>{{ $totalPersons }} x ₱{{ $ride->price }}</strong> </p>
                            <p>Total Price: <strong>₱{{ $formattedPricePerPerson }}</strong></p>
                        </div>
                    </div>

                    @endforeach
                    <div class="mt-4 alert alert-primary">

                        <p>Total Rides Price: <strong>₱{{ number_format($totalRidesPrice, 2) }}</strong></p>
                        <p>Total Entrance Fee: <strong>₱{{ number_format($totalEntranceFee, 2) }}</strong></p>

                        <p>Total Expenses:
                            <strong>₱{{ number_format($totalRidesPrice + $totalEntranceFee, 2) }}</strong></p>
                        <p>Savings:
                            <strong>₱{{ number_format($budget - ($totalRidesPrice + $totalEntranceFee), 2) }}</strong>
                        </p>

                    </div>
                    @if (($totalRidesPrice + $totalEntranceFee) > $budget)
                    <div class="alert alert-warning">
                        <p class="text-warning">Note: Please be aware that some of the rides exceed your budget. You
                            have the option to enjoy some of the rides, but not all of them.</p>
                    </div>
                    @endif
                </div>
                @endif



                @if ($categories == 'accommodation')
                <div class="d-flex flex-column">
                    @php
                    $counter = 0;
                    @endphp

                    @if ($totalPersons <= 0) <p>No accommodations available for the selected number of persons.</p>
                        @else
                        @foreach ($establishment->rooms as $accommodation)
                        @php
                        $price = $accommodation->price;
                        $budget = $budget;


                        if(($accommodation->price * $numberofdays) + $totalEntranceFee >= $budget) {
                        continue;
                        }

                        if($totalPersons > $accommodation->capacity) {
                        continue;
                        }

                        $counter++;

                        @endphp

                        <div class="card my-2">
                            <div class="card-body">

                                <p>Name: <strong>{{ $accommodation->name }}</strong></p>
                                <p>Capacity:<strong> {{ $accommodation->capacity }}</strong></p>
                                <p>Price: <strong> {{$numberofdays}} x ₱{{ $accommodation->price }}</strong></p>

                                <hr>

                                <p>Total Room Price: <strong>₱{{ $numberofdays * $accommodation->price }} </strong></p>
                                <p>Total Entrance Fee: <strong>₱{{ number_format($totalEntranceFee, 2) }}</strong></p>

                                <p>Total Expenses:
                                    <strong>₱{{ number_format($totalEntranceFee + ($accommodation->price * $numberofdays), 2) }}</strong>
                                </p>

                                <p>Savings:
                                    <strong>₱{{ number_format($budget - ($totalEntranceFee + ($accommodation->price * $numberofdays)), 2) }}</strong>
                                </p>
                            </div>
                        </div>

                        @endforeach

                        @if ($counter == 0)
                        <p class="text-danger">You budget is less than the total payable amount. </p>
                        @endif

                        @endif
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Add any other modal footer buttons if needed -->
            </div>
        </div>
    </div>
</div>


</div>
@endforeach

@if ($categories == 'accommodation')
@if ($counter == 0)
<div class="col-12">

    <div class="alert alert-warning">
        <p>
            "Apologies, but we couldn't find any results matching your search criteria. You might want to refine your
            search parameters, or it's possible that your budget is lower than the prices offered by the establishments.
            Thank you for understanding."
        </p>
    </div>
</div>
@endif
@endif
</div>
</section>
</div> --}}


@if ($categories == 'accommodation')
<section id="establishments">
    <div class="container">
        <div class="row my-4">
          <div class="col-md-12">
            <h2>Results: </h2>
          </div>
        </div>
        <div class="row mb-6">
            <div class="col-md-3">

              <div class="card p-2">
                <div class="p-2">
                  <h6>Sort by Price</h6>
                  <select class="form-control" id="sortByPrice">
                      <option value="hightolow">High to Low</option>
                      <option value="lowtohigh">Low to High</option>
                  </select>
                </div>

                <div class="p-2">
                  <h6>Price</h6>
                  <input class="my-2" type="text" id="amount" readonly style="border:0; color:#b10002; font-weight:bold;">
                
                  <div id="slider" class="mx-2"></div>
                </div>

                
                  
              </div>
              
            </div>
            <div class="col-md-9">
              <div class="row" id="dataContainer">
                @foreach ($establishments as $establishment)
                   
                  @foreach ($establishment->rooms as $accommodation)

                  @php
                    $totalPersons = $adults + $children;
                      if($accommodation->price > $budget ||  $totalPersons > $accommodation->capacity) continue;
                  @endphp

                  <div class="col-md-4 my-2" data-price="{{ $accommodation->price }}">

                      <div class="card p-2"> 
                          <div class="card-body">
                              <span class="badge badge-warning text-dark">{{ $accommodation->name }}</span>

                              @if ($accommodation->image_path)
                                <img class="img-rounded my-2 " style="object-fit: cover; max-width: 100%; min-height: 250px;" src="{{ asset($accommodation->image_path) }}" alt=""> 
                                @else

                                <img class="img-rounded my-2 " style="object-fit: cover; max-width: 100%; min-height: 250px;" src="{{ asset('/imgs/intro-logo.png') }}" alt=""> 
                              @endif

                              <h6 class="mb-2 text-small">{{ Str::limit($establishment->name, 20, '...') }}</h6>
                              <div class="d-flex justify-content-between align-items-center">
                                <span> Capacity: {{$accommodation->capacity}} </span> <span> Price: {{ $accommodation->price }}</span>
                              </div>
 
                              <a class="btn btn-primary mt-2 mb-0" href="{{ route('user.establishment', $establishment->id) }}">View Details</a>
                          </div> 
                      </div>
                  </div>
                  @endforeach
                @endforeach
              </div>
            </div>
        </div>
    </div>
</section>
@endif
@if ($categories == 'rides')
<section id="rides">
    <div class="container">
        <div class="row my-4">
          <div class="col-md-12">
            <h2>Results: </h2>
          </div>
        </div>
        <div class="row mb-6">
            <div class="col-md-3">

              <div class="card p-2">
                <div class="p-2">
                  <h6>Sort by Price</h6>
                  <select class="form-control" id="sortByPrice">
                      <option value="hightolow">High to Low</option>
                      <option value="lowtohigh">Low to High</option>
                  </select>
                </div>

                <div class="p-2">

                  <h6>Price</h6>
                  <input class="my-2" type="text" id="amount" readonly style="border:0; color:#b10002; font-weight:bold;">
                
                  <div id="slider" class="mx-2"></div>
                </div>
                  
              </div>
              
            </div>
            <div class="col-md-9">
              <div class="row" id="dataContainer">
                @foreach ($establishments as $establishment)
                   
                  @foreach ($establishment->rides as $activity)

                  @php
                    $totalPersons = $adults + $children;
                      if($activity->price > $budget ) continue;
                  @endphp

                  <div class="col-md-4 my-2" data-price="{{ $activity->price }}">

                      <div class="card p-2"> 
                          <div class="card-body">
                              <span class="badge badge-warning text-dark">{{ $activity->name }}</span>

                              @if ($activity->image_path)
                                <img class="img-rounded my-2 " style="object-fit: cover; max-width: 100%; min-height: 250px;" src="{{ asset($activity->image_path) }}" alt=""> 
                                @else

                                <img class="img-rounded my-2 " style="object-fit: cover; max-width: 100%; min-height: 250px;" src="{{ asset('/imgs/intro-logo.png') }}" alt=""> 
                              @endif

                              <h6 class="mb-2 text-small">{{ Str::limit($establishment->name, 20, '...') }}</h6>
                              <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-success"> Price: {{ $activity->price }}</span>
                              </div>
 
                              <a class="btn btn-primary mt-2 mb-0" href="{{ route('user.establishment', $establishment->id) }}">View Details</a>
                          </div> 
                      </div>
                  </div>
                  @endforeach
                @endforeach
              </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection


@section('scripts')

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    $(function () {
        $("#slider").slider({
            range: true,
            min: 0,
            max: {{ $budget ? $budget : 0 }},
            values: [0, {{ $budget ? $budget : 0 }}],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);

                // Loop through each room card
                $("#dataContainer .col-md-4").each(function () {
                    var roomPrice = parseFloat($(this).attr("data-price"));

                    // Check if the data-price is less than the lower value of the slider
                     if (roomPrice > ui.values[1] || roomPrice < ui.values[0]) {
                        $(this).fadeOut();
                    } else {
                        $(this).fadeIn();
                    }
                });
            }
        });
        $("#amount").val("$" + $("#slider").slider("values", 0) +
            " - $" + $("#slider").slider("values", 1));


             // Function to sort rooms based on data-price attribute
        function sortData(order) {
            var rooms = $('#dataContainer .col-md-4').toArray();

            rooms.sort(function (a, b) {
                var priceA = parseFloat($(a).data('price'));
                var priceB = parseFloat($(b).data('price'));

                if (order === 'hightolow') {
                    return priceB - priceA;
                } else {
                    return priceA - priceB;
                }
            });

            $('#dataContainer').empty().append(rooms);
        }

        // Event listener for sorting select change
        $('#sortByPrice').change(function () {
            var selectedOption = $(this).val();
            sortData(selectedOption);
        });

        // Initial sorting (default: high to low)
        sortData('hightolow');
    });
  </script>
@endsection