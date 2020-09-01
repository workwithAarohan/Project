<!DOCTYPE html>
<html>
<head>
<title>Laravel Demo</title>
<link rel="stylesheet"
href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"></head>
<body>
<div class="container">
<nav class="navbar navbar-inverse">
<div class="navbar-header">
<a class="navbar-brand" href="#">Laravel</a>
</div>
<ul class="nav navbar-nav">
<li><a href="{{ URL::to('category') }}">View All category</a></li>
<li><a href="{{ URL::to('subcat/create/'.$subcategory->id) }}">Create category</a>
</ul>
</nav>
<h1>Create a Nerd</h1>

<form action="{{url('brand/store')}}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        {{ Form::label('name', 'Title') }}
        {{ Form::text('name',null,array('class' => 'form-control')) }}
        <!-- {{ Form::label('name', 'Image') }} -->
        <!-- <input type="file" name="image" class="form-control"> -->
        <input type="hidden" name="subcat_id" value="{{ $subcategory->id}}">
    </div>
    {{ Form::submit('Create!', array('class' => 'btn btn-primary')) }}
</form>
</div>
</body>
</html>