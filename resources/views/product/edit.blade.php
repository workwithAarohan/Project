@extends('layouts.nav')

@section('title')
    Edit {{$product->name}}
@endsection

@section('style')
    .col-md-3,.col-md-4
    {
        -webkit-box-shadow: -1px 9px 4px -12px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px 9px 40px -12px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 9px 1px rgba(0,0,0,0.1);
    }
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 p-5 border" style="height:450px;">
                <img src="/image/{{$product->image}}" id="update_image" 
                    style="height: 300px; width: 300px;">
            </div>
            <div class="col-md-4 p-5 border" style="height: 450px;">
                {{ Form::model($product, array('route' => array('product.update', $product->product_id),
                    'method' => 'PUT', 'files' => true)) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }} <br>
                        {{ Form::label('name', 'Price:') }}
                        {{ Form::text('price', null, array('class' => 'form-control')) }} <br>
                        {{ Form::label('name', 'Image:') }} <br>
                        <input onchange="readURL(this);" type="file" name="image"
                         value="{{$product->image }}" style=" width: 250px;"><br><br>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    {{ Form::submit('Edit the product', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
            <div class="col-md-4  border" style="height: 450px; overflow-x: hidden;">
                <h6> {{$product->name}} </h6> <hr>
                @foreach($product as $products)
                    @foreach($product->description as $products)
                        <li>
                            <ul> {{$products->description}} </ul>
                        </li>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    <script>

        function readURL(input) {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();
                
                reader.onload = function (e) 
                {
                    
                    $('#update_image')
                    .attr('src', e.target.result)
                    .height(300)
                    .display(none);
                    
                };

                reader.readAsDataURL(input.files[0]);

            }
        }

    </script>
@endsection