@extends('layouts.nav')

@section('title')
  Dashboard
@endsection



@section('content')

<div id="demo" class="carousel slide mt-3" data-ride="carousel">

  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li> 
  </ul>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="text-center">
        <img class="card-img-top" src="/image/home.png" style="width:1090px; height: 400px; ">
      </div>
    </div>
    <div class="carousel-item">
      <div class="text-center">
        <img class="card-img-top" src="/image/background.png" style=" width:1090px; height: 400px;">
      </div>
    </div>
  </div>

  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="fas fa-chevron-left" style="font-size:2rem; color:black;" ></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="fas fa-chevron-right" style="font-size:2rem; color:black;"></span>
  </a>
</div>
<hr>

<div class="container-fluid mt-4 p-5">
  <h5 class="text ml-4">Categories</h5>
  <div class="row mb-5">
    @foreach($subcategory as $key => $value) 
      <a href="{{URL::to('product/allbrands/'.$value->id)}}" style="text-decoration: none; color: black;">
        <div class="card" style="width: 150px; height: 150px; border-radius: 1px;">
          <div class="text-center">
            <img class="card-img-top mt-1" src="/image/{{$value->image}}" style=" height: 80px; width: 80px;">
          </div>
          <div class="card-body" style="text-align:center;">
            <h6 class="card-title">{{$value->title}}</h6>
          </div>
        </div>
      </a>
    @endforeach
  </div>
  <hr>
  <h5 class="text ml-4">Just for You</h5>
  <div class="row mb-5">
    @foreach($product as $value)
      <a href="{{URL::to('showproduct/'.$value->product_id)}}" style="text-decoration: none;">
        <div class="card mr-3 mb-3" style="position:relative; cursor:pointer; width: 230px; height: 21rem;">
          <img class="card-img-top mt-2" src="/image/{{$value->image}}">
          <div class="card-body">
            <b><h6 class="card-title" style="color:black; height: 30px;">{{$value->name}}</h6></b> 
            <p style="color: orange; font-size: 17px;">Rs.{{$value->price}}</p>
          </div>
        </div>
      </a>
    @endforeach
  </div>
</div>

@endsection

