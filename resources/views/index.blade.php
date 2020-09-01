@extends('layouts.nav')

@section('title')
    {{$subcategory->title}}
@endsection

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
                <b>Related Categories:</b><br>
                {{$subcategory->title}}
                <hr>
                <b>Brands:</b> <br>
                    @foreach($brands as $key => $value)
                        {{$value->name}} <br>
                    @endforeach
                <hr>

                Service <hr>
                Location

            </div>
            <div class="col-md-10">
                <h5>{{$subcategory->title}}</h5>
                <hr>
                <div class="row mt-4">
                    @foreach($brands as $key => $values)
                        @foreach($values->products as $value)
                            <div class="col-md-3 mb-2">
                                <div class="card" onclick="redirect('{{url('showproduct/'.$value->product_id)}}')"
                                     style="position:relative; cursor:pointer; width: 230px; height: 25rem;
                                     border:none;">
                                    <img class="card-img-top mt-2" src="/image/{{$value->image}}" style="height: 240px;">
                                    <div class="card-body">
                                        <b><h6 class="card-title">{{$value->name}}</h6></b> 
                                        <p style="color: orange;">Rs.{{$value->price}}</p>
                                        <form action="{{URL::to('/addcart')}}" method="POST">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        function redirect(url)
        {
            window.open(url, '_self');
        }
    </script>
@endsection