<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="bootstrap-4/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.12.0-web/css/all.css">
    <script src="bootstrap-4/js/jquery-3.4.1.min.js"></script>
    <script src="bootstrap-4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light">
            <b><a class="navbar-brand" href="#">3Tᴇᴄʜɪᴇꜱ</a></b>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/image/category.png" alt="" style="width: 32px;">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" style="width:450px;">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">  
                                <i class="fas fa-search"></i>
                            </button> 
                        </form>
                    </li>
                    <li class="nav-item mt-1 ml-2" >
                        <a href="#" class="notification">
                            <i class="fas fa-shopping-cart mb-auto" style="font-size: 30px;"></i>
                            <!--  -->
                            
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-2">
                    @guest
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <!-- <a href="{{url('/login')}}" class="btn btn-outline-primary btn-hover" style="font-size: 14px;">
                                    <i class="fa fa-user mr-1" style="border-radius: 50%;padding: 0.4rem;
                                    background-color: #0275d8 ; color:white;"></i>
                                    SIGN IN
                                </a> -->
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
                                <img src="{{Auth::user()->image}}" style=" width:40px; height:40px; border-radius:50%;"> 
                                {{Auth::user()->firstname}}       
                            </a> 
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
</body>
</html>