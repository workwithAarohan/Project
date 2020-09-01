<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/bootstrap-4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome-free-5.12.0-web/css/all.css">
    <script src="/bootstrap-4/js/jquery-3.4.1.min.js"></script>
    <script src="/bootstrap-4/js/popper.min.js"></script>
    <script src="/bootstrap-4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/font.css" rel="stylesheet">
    <title>@yield('title')</title> 

    <style>
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
        @yield('style');
    </style>
</head>
<body>
    
    @inject('cartcount','App\Cart')

    <div class="container-fluid wrapper">
        <nav class="navbar navbar-expand-lg navbar-light">
            <b><a class="navbar-brand" href="{{URL::to('dashboard')}}">3Tᴇᴄʜɪᴇꜱ</a></b>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <div class="dropdown show">
                            <button class="btn btn-default opened dropdown-toggle" href="#" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/image/category.png" style="width: 32px;">
                            </button>
                            <ul class="dropdown-menu closed" aria-labelledby="navbarDropdown">
                                <li class="dropdown-submenu">
                                    <h6 class="text ml-5">Categories</h6>
                                    <div class="dropdown-divider"></div>
                                    @foreach($dropdown as $value)
                                        <a class="dropdown-item dropdown-toggle" href="#">{{$value->title}}</a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu">
                                                <h6 class="text ml-5">Sub-Categories</h6>
                                                <div class="dropdown-divider"></div>
                                                @foreach($value->subcategories as $subcategory)
                                                    <a class="dropdown-item dropdown-toggle" href="{{URL::to('product/allbrands/'.$subcategory->id)}}">{{$subcategory->title}}</a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-submenu">
                                                            <h6 class="text ml-5">Brands</h6>
                                                            <div class="dropdown-divider"></div>
                                                            @foreach($subcategory->brands as $brand)
                                                                <a class="dropdown-item" href="{{URL::to('product/'.$brand->id)}}">{{$brand->name}}</a>
                                                            @endforeach
                                                        </li>
                                                    </ul>     
                                                @endforeach
                                            </li>
                                        </ul>
                                        
                                    @endforeach  
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                </ul>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" role="search" action="{{URL::to('/search')}}" method="GET">
                        @csrf
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" required style="width:450px;">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">  
                                <i class="fas fa-search"></i>
                            </button> 
                        </form>
                    </li>
                    @auth
                        <li class="nav-item mt-1 ml-2" >
                            <a href="{{URL::to('counter/'.Auth::user()->id)}}" class="notification">
                                <i class="fas fa-shopping-cart mb-auto" style="font-size: 30px;"></i>
                                @if($cartcount->where('user_id',Auth::user()->id)->sum('quantity')!=0)
                                    <span class="badge">{{$cartcount->where('user_id',Auth::user()->id)->sum('quantity')}}</span>
                                @endif      
                            </a>
                        </li>
                    @endauth
                </ul>
                <ul class="navbar-nav mr-2">
                    @guest
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{url('/login')}}" 
                                    style="border: 2px solid #0275d8; padding: 10px  10px; font-size: 14px; color: #0275d8;
                                    border-radius: 5px; background-color: white; text-decoration: none; text-align: center">
                                    <i class="fa fa-user mr-1" style="border-radius: 50%; padding: 0.4rem;
                                    background-color: #0275d8 ; color:white;"></i>
                                    SIGN IN
                                </a>
                            </li>
                        @endif
                        
                        @else
                        <li class="nav-item" >
                            <a class="nav-link" href="{{ url('/profile') }}" style="padding:5px;" title="View Profile">
                                <img src="/image/{{Auth::user()->image}}" style=" width:40px; height:40px; border-radius:50%;"> 
                                {{Auth::user()->firstname}}       
                            </a> 
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
    
    @yield('content')

    <script>
 
        $('.dropdown-menu a.dropdown-toggle').on('mouseenter', function(e) 
        {
            if (!$(this).next().hasClass('show')) 
            {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');

            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) 
            {
                $('.dropdown-submenu .show').removeClass("show");
            });
            return false;
        });
    </script>
</body>
</html>