@extends('layouts.nav')

@section('title')
    Search: {{$query}}
@endsection

@section('content')
    <div>
        @if (Session::has('message'))
            <div class="alert alert-info" style="width:50%;">{{ Session::get('message') }}</div>
        @endif
    </div>
    @if(isset($details))
        <div class="container mt-4">
        {{count($details)}} items found for "{{$query}}" <hr>
            <div class="row">  
                @foreach($details as $key => $product)   
                        <a href="{{URL::to('showproduct/'.$product->product_id)}}" style="text-decoration: none;">
                            <div class="card mr-3 mb-3" style="position:relative; cursor:pointer; width: 210px; height: 21rem;">
                                <img class="card-img-top mt-2" src="/image/{{$product->image}}">
                                <div class="card-body">
                                    <b><h6 class="card-title" style="color:black; height: 35px;">{{$product->name}}</h6></b> 
                                    <p style="color: orange; font-size: 17px;">Rs.{{$product->price}}</p>
                                </div>
                            </div>
                        </a>
                @endforeach 
            </div>
        </div>
    @endif
@endsection