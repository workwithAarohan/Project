<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="/bootstrap-4/css/bootstrap.min.css">
    <script src="/bootstrap-4/js/bootstrap.min.js"></script>
    <script src="/bootstrap-4/js/jquery-3.4.1.min.js"></script>
    <style>
    
    .container
    {
      margin-top: 50px ;

    }
    .design
    {
      padding: 50px 35px;
      border: 1px solid;
      border-color: lightgrey;
      border-radius: 5px;
      height: 500px;
    }
    .design h4,p
    {
        text-align: center;
    }

    #second
    {
      display: none;
    }

    .form-group 
    {
        position:relative;
    }

    .form-group>label
    {
        position: absolute;
        top:-10px;
        left:13px;
        background-color: white;
        text-align: center;
        color:  #106aec  ;
        font-size: 15px;
        padding: 0 5px;
    }

  </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 design">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div id="first">
                        <h4>3Tᴇᴄʜɪᴇꜱ</h4>
                        <h4>Sign in</h4>
                        <p>to continue to 3Techies.com</p><br>
                        <div class="form-group">
                            <label class="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email" 
                            style="height: 50px;">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><br>
                        <div class="form-group">
                            <label class="password">Password</label>
                            <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" style="height: 50px;"
                            name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br><br>
                        <b>
                            <a href="{{URL::to('register')}}" style="font-size:13px; text-decoration:none; text-align: left;">
                                Create account
                            </a>
                        </b>  
                        <button type="submit" class="btn btn-primary" style="float:right; width: 100px;">
                            Sign In
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

</body>
</html>