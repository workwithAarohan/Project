@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
    <div class="container mt-4">
        <h4>Categories:
            <span class="fa-stack">
                <span class="far fa-circle fa-stack-2x"></span>
                <strong class="fa-stack-1x" style="font-size:80%;">
                    {{$category->count}}   
                </strong>
            </span>
        </h4> 
        <hr>
        <div class="row mt-3">
            <div class="col-md-2 mb-3" id="add_cat">
                <button type="button" id="add" style="color:black; text-decoration:none; border:none;
                background-color:white;">
                    <div class="card mt-2" style="height:11rem">
                        <span class="fas fa-plus mt-4" style="text-align: center; font-size: 80px;"></span>
                        <div class="card-body">
                            <span class="text">
                                Add Category
                            </span>
                        </div>
                    </div>
                </button>
            </div>
            <div class="col-md-4" id="form" style="display: none;">
                <h4 class="text">Add  Category</h4>
                <form action="{{url('category')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <input type="text" name="title" placeholder="Title" class="form-control required">
                    </div>
                    <div class="form-group">
                        <label for="">Image</label><br>
                        <input type="file" name="image" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger btn_remove">Cancel</button>
                    </div>
                </form>
                <hr>
            </div>
            @foreach($category as $value)
                <div class="col-md-2 mb-3">
                    <div class="card mt-2" onclick="redirect('{{url('subcat/'.$value->id)}}')" style="height:11rem; position:relative; cursor:pointer;">
                        <div class="design " style="display: none;">
                            <a class="btn" href=" {{URL::to('del/'.$value->id)}} "
                            style="position: absolute; top: 0px; right: 0px;">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a href="{{ URL::to('category/' . $value->id . '/edit') }}" class="btn"
                            style="position: absolute; top: 0px; left: 0px;">
                                <i class="fa fa-pen"></i>
                            </a>
                        </div>
                        <div class="text-center">
                            <img class="card-img-top" src="/image/{{$value->image}}"
                            style="height: 90px; width: 50%">
                        </div>
                        
                        <div class="card-body">
                            <p style="text-align:center; height: 40px;">
                                {{$value->title}}
                            </p>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>

        

        function redirect(url)
        {
            window.open(url, '_self');
        }
        
        $(document).ready(function()
        {
            $('#add').click(function()
            {
                $('#add_cat').hide();
                $('#form').show();
            });  

            $( ".card" )
            .hover(function() 
            {
                $(".design").show();  
                
            })
            .on("mouseleave", function() 
            {
                $(".design").hide();
            });
        
            $(document).on('click', '.btn_remove', function()
            {  
                $('#form').hide();
                $('#add_cat').show(); 
            });    
        });

        // function destroy(url)
        // {
        //     var question = confirm('Ramro sanga herera button click gareko ta ho ni?');
        //     if(question==true)
        //     {
        //         window.open("{{url('/category')}}", '_self');
        //     }
        //     else
        //     {
        //         alert('OK done');
        //         window.open("{{url('/category')}}", '_self');
        //     }
        // }
    </script>
@endsection