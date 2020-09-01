@extends('layouts.nav')

@section('title')
    Counter
@endsection

@inject('cartcount','App\Cart')

@section('style')
    
    .wrapper
    {
        background-color: white;
    }
    
    body 
    {
        background-color:  #eae8e8;
    }
    

    .col1,.col2
    {
        background-color: white;
        margin:20px 0px;
        padding: 25px;
        box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
        width: 1000px;
    }

@endsection

@section('content')
    <div class="container-fluid mt-3" style="padding: 0px 40px;">
        <div class="row ">
            <div class="col-md-8 col1" style="height: 490px;">
                <b><h5>My Cart ({{$cartcount->where('user_id',Auth::user()->id)->sum('quantity')}})</h5></b>
                @if($cartcount->where('user_id',Auth::user()->id)->sum('quantity') !=0)
                    <div class="design mt-4" style="height:310px; overflow-x: hidden;" >
                        @foreach($counter as $key => $value)
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{URL::to('showproduct/'.$value->product_id)}}">
                                        <img src="/image/{{$value->image}}" style="padding:5px; width: 100px; ">                            
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <h4>{{$value->name}}</h4>
                                    <p>Rs. {{$value->price}}</p>
                                    <a type="button" href="{{URL::to('delcart/'.$value->cart_id)}}" class="btn btn-default">
                                        <b>REMOVE</b>
                                    </a>
                                </div>
                                <div class="col-md-3 mt-2" style="float: right;">
                                    <label for="">Quantity:</label>
                         
                                    {{ Form::model($value, array('route' => array('cart.update', $value->cart_id),
                                        'method' => 'PUT')) }}
                                        <input type="number" name="quantity" value="{{$value->quantity}}" min="1" max="10" step="1"
                                        style="width: 70px; height: 30px; text-align: center; border: 1px solid lightgrey;
                                            cursor: text;"/>
                                        
                                        <button class="btn btn-default" type="submit">
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                    {{ Form::close() }}
                                </div>
                            </div>    
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col">
                            <hr>
                            
                            <button type="submit" class="btn btn-primary mr-4"  data-toggle="modal" data-target="#myModal"
                                style="float:right; font-size: 1.4rem; padding: 2px 25px">
                                    Place Order
                            </button>
                            <div class="modal" id="myModal" style="">
                                <div class="modal-dialog" style="max-width: 850px!important;">
                                    <div class="modal-content">
                                    
                                        <div class="modal-header">
                                            <h4 class="modal-title">Orders</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <div class="row">
                                                @foreach($counter as $key => $value)
                                                    <div class="col-md-2">
                                                        <img src="/image/{{$value->image}}" style="padding:5px; width: 100px; ">
                                                    </div>
                                                @endforeach
                                            
                                                <p style="margin-top: 100px; margin-left:200px;">Note: Cash on Delivery.</p>

                                            </div>
                                            

                                            <br>
                                            <h5>Contact Details: </h5> <hr>
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    {{ Form::model( array('route' => 'user.update',
                                                        'method' => 'PUT')) }}
                                                        
                                                        <label for="">Address: </label>
                                                        <input type="text" name="address" class="form-control w-50" value="{{Auth::user()->address}}"><br>           
                                                        <label for="">Phone: </label>
                                                        <input type="text" name="phone" class="form-control w-50" value="{{Auth::user()->phone}}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                            
                                            <form action="{{URL::TO('order')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="price" value="{{$counter->totalprice}}">
                                            </form>
                                        </div>
                                       
                                        <div class="modal-footer">
                                            
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <hr>    
                    <div class="empty-group" style="padding: 100px 0;">
                        <h6 align="center" style="font-size: 2rem;">
                            Paila kei saman ta rakh cart maa.
                        <h6>
                        <h5 align="center">Cart khali cha.</h5>
                    </div>
                @endif  
            </div>
            <div class="col-md-4 col2" style="height: 490px;">
                <h5>Payment Details</h5><hr>
                <div class="row" style="height: 300px; overflow-x: hidden;">
                    <div class="col">
                        <table width="360px">
                            <tr>
                                <td>
                                    @foreach($counter as $value)
                                        <p>{{$value->name}} ({{$value->quantity}}): </p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($counter as $value)
                                        <p>Rs. {{$value->totprice}}</p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Delivery: </p>
                                </td>
                                <td>
                                    <p> FREE </p>
                                </td>
                            </tr>
                        </table>

                    </div>   
                </div><hr>
                <div class="row">
                    <div class="col">
                        <table>
                            <tr>
                                <td width="240px">
                                    <b>Total: </b>
                                </td>
                                <td>
                                    <b>Rs. {{$counter->totalprice}} </b> 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        
    </div>

    <script src="/bootstrap-input-spinner.js"></script>

    <script>
        $("input[type='number']").InputSpinner();
    </script>
@endsection