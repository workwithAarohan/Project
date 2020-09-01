@extends('layouts.nav')

@section('title')
    {{$product->name}}
@endsection

@section('style')
    body, .breadcrumb
    {
        background:  #efefef ;
    }
    .container, .wrapper
    {
        background-color: white;
    }
    .checked 
    {
        color: orange;
    }
    .button
    {
        padding: 8px 40px;
    }

    .starrating > input {display: none;}  

    .starrating > label:before 
    { 
        content: "\f005";
        margin: 2px;
        font-size: 1rem;
        font-family: FontAwesome;
        display: inline-block; 
    }

    .starrating > label
    {
    color: #222222;
    }

    .starrating > input:checked ~ label
    { color: orange ; } 

    .starrating > input:hover ~ label
    { color: orange ;  } 


@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ml-5 pl-5 mt-2">
            <li class="breadcrumb-item"><a href="{{URL::to('product/'.$brand->id)}}">{{$brand->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
        </ol>
    </nav>

    <div class="container mb-3">
        <div class="row pt-4">
            <div class="col-md-4 mb-4">
                <img src="/image/{{$product->image}}" style="width: 350px;">
            </div>
            <div class="col-md-5 mt-3">
                <h5>{{$product->name}}</h5>
                @if($review->count !=0)
                    @for($i=1;$i<=$review->ratingcount;$i++)
                        <span class="fa fa-star checked" style="font-size:1rem;"></span>
                    @endfor
                    @for($i=1;$i<=5-($review->ratingcount);$i++)
                        <span class="fa fa-star pb-3" style="font-size:1rem;"></span>
                    @endfor
                    &ensp; Rating
                @else
                    @for($i=1;$i<=5;$i++)
                        <span class="fa fa-star pb-3" style="font-size:1rem;"></span>
                    @endfor
                    &ensp; Not Rated
                @endif
                <br><br>
                <p>Brand:  <a href="#">{{$brand->name}}</a> | <a href="{{URL::to('product/'.$brand->id)}}">More from {{$brand->name}}</a></p><hr>
                <h4> Rs. {{$product->price}} </h4> <br>  

                <div class="d-flex">
                    <button class="btn btn-primary button mr-2">Buy Now</button> 
                    <form action="{{URL::to('addcart')}}" method="POST">
                    @csrf
                        
                        <input type="hidden" name="product_id" value="{{$product->product_id}}">
                        <button type="submit" class="btn btn-success button" style="width:100%;">
                            + Add to cart
                        </button>
                    </form>
                </div>
                
            </div>

            <div class="col-md-3 mt-2">
                <h6>Delivery Options</h6> <br>
                <i class="fa fa-map-maker">&#xf3c5;</i> Address
                <a href="#" class="btn border ml-2">Edit</a><hr>
                <h6><b>Home Delivery: Rs. 0</b></h6> <hr>
                <h6>Cash on Delivery</h6>
            </div>
        </div>
    </div>

    <div class="container mb-3">
        @auth
            <div class="float-right mt-4">
                @if(Auth::user()->isAdmin !=0)
                    <form action="{{URL::to('description')}}" method="POST">
                    @csrf
                        <input type="text" name="description" class="form-control" placeholder="Add Description">
                        <input type="hidden" name="product_id" value=" {{$product->product_id}} ">
                    </form>
                @endif
            </div>
        @endauth

        <div class="row p-4" id="remove">
            <h4 class="mt-2">Product details of {{$product->name}}</h4>
        </div>
        
        @if($description->count>0)
            <ul>
                <div class="row pb-5">
                    @foreach($description as $value)
                        <div class="col-md-5 mr-5">
                            <li> 
                                {{$value->description}}
                                </a>
                            </li> 
                        </div>
                    @endforeach
                </div>
            </ul>
        @else
            <div class="row pb-5 justify-content-center">
                <h4>No description available.</h4>
            </div>
        @endif
    </div>

    <div class="container mb-3 pb-5">
        <div class="row p-4">
            <h4>Review ({{$review->count}})</h4>
        </div>

        <div class="row p-3 mb-3">
            @auth 
                <div class="col-md-1">
                    <img src="/image/{{Auth::user()->image}}" style="width:50px; height:50px; border-radius:50%;">
                    
                </div>
                <div class="col-md-6">
                    <form action="{{URL::to('review/store/')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->product_id}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="text" class="form-control" name="comment" placeholder="Add a comment" required>
                        
                        <div class="starrating risingstar d-flex flex-row-reverse">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="5 star"></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 star"></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 star"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 star"></label>
                            <input type="radio" id="star1" name="rating" value="1" required/>
                            <label for="star1" title="1 star"></label>
                            <h6 class="mt-1">Rating: &emsp;</h6> 
                        </div>
                        
                        <button type="submit" class="btn border">Add Review <i class="fas fa-plus"></i></button>
                    </form>

                </div>

            @else
                <div class="col border p-2">
                    <p><a href="{{URL::to('/login')}}">Login</a> to review.</p>
                </div>
            @endauth
        </div>
        
        @foreach($review as $value)
            <div class="row p-3 bg-light mb-2">
                @foreach($value->user as $user)
                    <div class="col-md-1">
                        <img src="/image/{{$user->image}}" style="width:50px; height:50px; border-radius:50%;">
                    </div>
                    <div class="col-md-8">
                        <a href="{{URL::to('profile/'.$user->image)}}" style="text-decoration: none;"> 
                            {{$user->firstname}} {{$user->lastname}} &ensp;&emsp;
                        </a>
                        @for($i=1;$i<=$value->rating;$i++)
                            <span class="fa fa-star checked" style="font-size:0.8rem;"></span>
                        @endfor
                        @for($i=1;$i<=5-($value->rating);$i++)
                            <span class="fa fa-star pb-3" style="font-size:0.8rem;"></span>
                        @endfor
                        <br>
                        <p>{{$value->comment}}</p>
                        
                    </div>
                @endforeach
            </div>
        @endforeach
        
    </div>
        
    
@endsection