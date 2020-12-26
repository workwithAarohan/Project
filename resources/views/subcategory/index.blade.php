@extends('layouts.nav')

@section('title')
  {{$category->title}}
@endsection

@section('content')
  <div class="container mt-4">
    <h4>Sub-Categories:
      <span class="fa-stack">
        <span class="far fa-circle fa-stack-2x"></span>
        <strong class="fa-stack-1x" style="font-size:80%;">
            {{$subcategory->count}} 
        </strong>
      </span>
    </h4>
    <hr>
    <div class="row mt-3">
      <div class="col-md-2 mb-3 " id="add_subcat">
        <button type="button" id="add" style="color:black; text-decoration:none; border:none;
        background-color:white;">
          <div class="card mt-2" style="height:11rem; width: 8.7rem;">
            <span class="fas fa-plus mt-3" style="text-align: center; font-size: 80px;"></span>
              <div class="card-body">
                  <span class="text mb-2">
                      Add SubCategory
              </div>
            </div>
        </button>
      </div>
      <div class="col-md-4" id="form" style="display: none;">
        <h4 class="text">Add Sub-Category</h4>
        <form action="{{url('subcategory')}}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <input type="text" name="title" placeholder="Title" class="form-control required">
          </div>
          <div class="form-group">
            <label for="">Image</label><br>
            <input type="file" name="image" required>
          </div>
          <input type="hidden" name="cat_id" value="{{ $category->id}}">
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger btn_remove">Cancel</button>
          </div>
        </form>
        <hr>
      </div>
      @foreach($subcategory as $key => $value)
        <div class="col-md-2 mb-5">
          <div class="card mt-2" onclick="redirect('{{url('brand/'.$value->id)}}')" style="height:11rem; position:relative; cursor:pointer;">
            <div class="design " style="display: none;">
                <a href="{{ URL::to('delsubcat/' . $value->id) }}" class="btn" 
                style="position: absolute; top: 0px; right: 0px; opacity: 0.9;">
                    <i class="fa fa-trash"></i>
                </a>
                <a href="{{ URL::to('subcategory/' . $value->id . '/edit') }}" class="btn"
                style="position: absolute; top: 0px; left: 0px; opacity: 0.9;">
                    <i class="fa fa-pen"></i>
                </a>
            </div>
            <div class="text-center">
              <img class="card-img-top mt-2" src="/image/{{$value->image}}"
              style="height: 90px; width:50%;">
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
    $( ".card" )
    .on("mouseenter", function() 
    {
      $(".design").show();
        
    })
    .on("mouseleave", function() 
    {
      $(".design").hide();
    });

    function redirect(url)
    {
      window.open(url, '_self');
    }
    $(document).ready(function()
    {
      $('#add').click(function()
      {
        $('#add_subcat').hide();
        $('#form').show();
      });  
  
      $(document).on('click', '.btn_remove', function()
      {  
        $('#form').hide();
        $('#add_subcat').show(); 
      });    
    });
    </script>
@endsection