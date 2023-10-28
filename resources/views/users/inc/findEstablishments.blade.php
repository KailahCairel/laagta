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

                                          <option value="{{ $destination->id }}" {{ $request->location == $destination->id ? 'selected':''  }}> {{ $destination->name }} </option>

                                          @endforeach

                                      </select>
                                  </div>

                                  <div class="form-group col-md-2 p-1">
                                      <label for="categories">Services</label>
                                      <select class="form-control" name="categories" id="categories">
                                          <option value="accommodation" {{ $request->categories == "accommodation" ? 'selected':''  }}>Accomodation</option>
                                          <option value="rides" {{ $request->categories == "rides" ? 'selected':''  }}>Rides</option>
                                          <option value="venue" {{ $request->categories == "venue" ? 'selected':''  }}>Venue</option>
                                      </select>
                                  </div> 

                                  {{-- If accomodation is selected --}}
                                  <div class="col-md-2 p-1 form-group" id="numberOfDaysCont">
                                      <label for="numberofdays">Length of Stay</label>
                                      <input type="number" class="form-control" name="numberofdays"
                                          id="numberofdays" value="{{ $request->numberofdays }}"
                                          required />
                                  </div>


                                  <div class="col-md-2 p-1 form-group">
                                      <label for="adults">Number of adults</label>
                                      <input type="number" class="form-control" name="adults"
                                          id="adults" value="{{ $request->adults }}" required />
                                  </div>
                                  <div class="col-md-2 p-1 form-group">
                                      <label for="childs">Number of childrens</label>
                                      <input type="number" class="form-control" name="childs"
                                          id="childs" value="{{ $request->childs }}" required />
                                  </div> 
  
                                  <div class="col-md-2 p-1 form-group">
                                      <label for="budget">What is your budget?</label>
                                      <input type="number" class="form-control" name="budget"
                                          id="budget" value="{{ $request->budget }}" required />
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