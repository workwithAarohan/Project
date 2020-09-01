@extends('layouts.nav')

@section('title')
    Edit {{$brand->name}}
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
            <div class="col-md-3 border" style="height:400px; padding: 120px 70px;">
                <img src="/image/{{$brand->image}}" id="update_image" 
                    style="height: 120px; width: 120px;">
            </div>
            <div class="col-md-4 p-5 border" style="height: 400px;">
                {{ Form::model($brand, array('route' => array('brand.update', $brand->id),
                 'method' => 'PUT', 'files' => true)) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }} <br>
                        {{ Form::label('name', 'Image:') }} <br>
                        <input onchange="readURL(this);" type="file" name="image"
                         value="{{$brand->image }}" style=" width: 250px;"><br><br>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    {{ Form::submit('Edit the brand', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <script>

        function readURL(input) 
        {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();
                
                reader.onload = function (e) 
                {
                    
                    $('#update_image')
                    .attr('src', e.target.result)
                    .height(120)
                    .display(none);
                    
                };

                reader.readAsDataURL(input.files[0]);

            }
        }

    </script>

@endsection