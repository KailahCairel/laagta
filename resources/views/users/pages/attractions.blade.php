@extends('layouts.app')

@section('content') 
<section id="establishments">
    <div class="container">
        <div class="row my-6">
          <div class="col-md-12">
            <h2 class="text-center">Views</h2>
          </div>
        </div>
        <div class="row my-6">  
            @foreach ($establishments as $establishment)
                <div class="col-lg-4 col-sm-6 my-2">

                    <div class="card">
                        <div class="card-body">

                            @if (count($establishment->images) > 0)
                            <img src="{{ asset('storage/' . $establishment->images[0]->image_path) }}" alt="">
                            @endif

                            <h6>{{ Str::limit($establishment->name, 35) }}</h6>

                            <a class="btn btn-primary" href="{{ route('user.establishment', $establishment->id) }}">View
                                Details</a>
                        </div> 
                    </div>


                </div>
            @endforeach 
        </div>
    </div>
</section> 

@endsection
 