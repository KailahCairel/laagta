@extends('layouts.app')

@section('content') 
  <div class="pt-5 pb-6 bg-cover" style="background-image: url('{{asset('/assets/img/header-blue-purple.jpg')}}')"></div>

  <div class="container my-3 py-3" id="user">
     
    <section id="establishments">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
            
            <div class="card">
                
                <div class="card-body">
                    <h4>Search Query: </h4>
                    <span class="d-block"><strong>Destination:</strong> {{ $destination->name }}</span>
                    <span class="d-block"><strong>Categories:</strong> {{ $categories }}</span>
                    <span class="d-block"><strong>Budget:</strong> ₱{{ $budget }}</span>
                    <span class="d-block"><strong>Number of adults:</strong> {{ $adults }}</span>
                    <span class="d-block"><strong>Number of childrens:</strong> {{ $children }}</span>
                    @if ( $numberofdays )
                    <span class="d-block"><strong>Number of Days:</strong> {{ $numberofdays }}</span>
                    @endif

                </div>
            </div>

        </div>
      </div>
      <div class="row mt-6 mb-6" > 
        @foreach ($establishments as $establishment)
          <div class="col-lg-4 col-sm-6 ">
  
            <div class="card">
              <div class="card-header py-0"> <h4>{{ $establishment->name }}</h4> </div>
              <div class="card-body"> 
 
                @if (count($establishment->images) > 0)
                    <img src="{{ asset('storage/' . $establishment->images[0]->image_path) }}" alt="">   
                @endif 

                <p>{{ Str::limit($establishment->description, 150) }}</p>

                
              </div>
              <div class="card-footer">
                <button class="btn btn-primary view-details" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $establishment->id }}">View Details</button>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="detailsModal{{ $establishment->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel"><span class="text-uppercase">{{ $categories }}</span> - {{ $establishment->name }}</h5>
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
                                        
                                        <p>Total Expenses: <strong>₱{{ number_format($totalRidesPrice + $totalEntranceFee, 2) }}</strong></p>
                                        <p>Savings: <strong>₱{{ number_format($budget - ($totalRidesPrice + $totalEntranceFee), 2) }}</strong></p>
                                        
                                      </div>
                                    @if (($totalRidesPrice + $totalEntranceFee)  > $budget)
                                        <div class="alert alert-warning">
                                          <p class="text-warning">Note: Please be aware that some of the rides exceed your budget. You have the option to enjoy some of the rides, but not all of them.</p>
                                        </div>
                                    @endif
                                </div>
                            @endif



                            @if ($categories == 'accommodation')
                                <div class="d-flex flex-column">
                                    @php
                                        $counter = 0;
                                    @endphp
                                
                                    @if ($totalPersons <= 0)
                                        <p>No accommodations available for the selected number of persons.</p>
                                    @else
                                        @foreach ($establishment->rooms as $accommodation)
                                            @php
                                                $price = $accommodation->price;
                                                $budget = $budget;

                                                
                                                if(($accommodation->price * $numberofdays) + $totalEntranceFee >= $budget) {
                                                  continue;
                                                }

                                                $counter++; 

                                            @endphp

                                            <div class="card">
                                                <div class="card-body">

                                                  <p>Name: <strong>{{ $accommodation->name }}</strong></p>
                                                  <p>Capacity:<strong> {{ $accommodation->capacity }}</strong></p>
                                                  <p>Price: <strong> {{$numberofdays}} x ₱{{ $accommodation->price }}</strong></p>
                                                  
                                            <hr>

                                                  <p>Total Room Price: <strong>₱{{ $numberofdays * $accommodation->price }}  </strong></p>
                                                  <p>Total Entrance Fee: <strong>₱{{ number_format($totalEntranceFee, 2) }}</strong></p>
                                                  
                                                  <p>Total Expenses: <strong>₱{{ number_format($totalEntranceFee + ($accommodation->price * $numberofdays), 2) }}</strong></p>

                                                  <p>Savings: <strong>₱{{ number_format($budget - ($totalEntranceFee + ($accommodation->price * $numberofdays)), 2) }}</strong></p>
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
      </div>
    </section>
  </div>  
 
@endsection

  