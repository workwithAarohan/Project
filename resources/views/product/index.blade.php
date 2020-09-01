@extends('layouts.nav')

@section('title', @$brand->name)
    

@section('style')
    .card:hover
    {
        -webkit-box-shadow: -1px 9px 4px -12px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 2px 3px rgba(0,0,0,0.2);
    }
@endsection

@section('content')
    <div class="container mt-4 ml-5">
        <div class="row">
            <div class="col-md-2">
                <h5>Related Brands:</h5>
                <h6 href=""> {{$brand->name}} </h6>
                <hr>
                Brand: <br>
                <a href="#" style="text-decoration: none;">  
                    <i class="far fa-square">
                        <h6>{{$brand->name}}</h6>
                    </i> 
                </a>
                <hr>

            </div>
            <div class="col-md-10">
                <h4>{{$brand->name}}</h4>
                <p class="text">{{$product->count}} items found.</p>

                <hr>
                <div class="row mt-4">
                    @auth
                        @if(Auth::user()->isAdmin != 0)
                            <div class="col-md-3 mb-2" id="add_product">
                                <a id="add" style="color:black; border:none; cursor:pointer; background-color:white;">
                                    <div class="card p-5" style="height:25rem; width: 14.4rem;">
                                        <span class="fas fa-plus mt-4" style="text-align: center; font-size: 80px;"></span>
                                        <div class="card-body">
                                            <span class="text">
                                                Add Product
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-5" id="form" style="display: none;">
                                <h4 class="text">Add Product</h4>
                                <form action="{{url('product/store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Name" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="price" placeholder="Price" class="form-control required">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Image</label><br>
                                        <input type="file" name="image" required>
                                    </div>
                                    <input type="hidden" name="brand_id" value="{{$brand->id}}">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger btn_remove">Cancel</button>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        @endif
                    @endauth
                    @foreach($product as $key => $value)
                        <div class="col-md-3 mb-2">
                            <div class="card" onclick="redirect('{{url('showproduct/'.$value->product_id)}}')" 
                            style="position:relative;border:none; cursor:pointer; width: 230px; height: 25rem;">
                                @auth
                                    @if(Auth::user()->isAdmin)
                                        <div class="design " style="display: none;">
                                            <a href="{{ URL::to('delproduct/' . $value->product_id) }}" class="btn" 
                                            style="position: absolute; top: 0px; right: 0px; ">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="{{ URL::to('product/' . $value->product_id . '/edit') }}" class="btn"
                                            style="position: absolute; top: 0px; left: 0px;">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endauth
                                <img class="card-img-top mt-2" src="/image/{{$value->image}}" style="height: 240px;">
                                <div class="card-body">
                                    <b><h6 class="card-title">{{$value->name}}</h6></b> 
                                    <p style="color: navorange;">Rs.{{$value->price}}</p>
                                    <form action="{{URL::to('addcart')}}" method="POST" >
                                    @csrf
                                        <input type="hidden" name="product_id" value="{{$value->product_id}}">
                                        <button type="submit" class="btn btn-primary" style="width:100%;">
                                            + Add to cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        
        $(document).ready(function()
        {
            $( ".card" )
            .on("mouseenter", function() 
            {
                $(".design").show();
                
            })
            .on("mouseleave", function() 
            {
                $(".design").hide();
            });
            $('#add').click(function()
            {
                $('#add_product').hide();
                $('#form').show();
            });  
        
            $(document).on('click', '.btn_remove', function()
            {  
                $('#form').hide();
                $('#add_product').show(); 
            });    
        });
        function redirect(url)
        {
            window.open(url, '_self');
        }
    </script>
@endsection