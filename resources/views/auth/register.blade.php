<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign Up</title>
  <link rel="stylesheet" href="bootstrap-4/css/bootstrap.min.css">
  <script src="/bootstrap-4/js/jquery-3.4.1.js"></script>
  <script src="/bootstrap-4/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="">

  <style>
    .input-group-text
    {
      background-color: white;
      
    }
    .container
    {
      border: 1px solid;
      border-color: lightgrey;
      border-radius: 5px;
      width: 750px;
      margin-top: 30px;
      font-family: Arial, Helvetica, sans-serif;  
    }
    .col-md-7
    {
      padding: 50px 35px;
    }


    #design
    {
      border-right-style: none;
    }

    form .input-group
    {
      position: relative;
    }

    form .input-group label
    {
      position: absolute;
      left: 100px;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-md-pull-8">
        <h3>3Tᴇᴄʜɪᴇꜱ</h3>
        <h3>Create an account</h3>
        <p>to buy the products.</p><br>
        <form action="{{ url('/register') }}" method="POST">
        @csrf
          <div class="input-group">
            <input type="text" class="form-control"
            name="firstname" placeholder="First Name" style="margin-right: 10px;" required>
            <input type="text" class="form-control" 
            name="lastname" placeholder="Last Name" required>
          </div><br>
          <div class="input-group">
            <input type="text" name="username" class="form-control" id="design" placeholder="Email">
            <div class="input-group-append">
              <span class="input-group-text mb-2" id="basic-addon2">@3Techies.com</span>
            </div>
          </div>
          <h6 style="font-size:small;">You can use letters, numbers & periods</h6><br>
          <div class="input-group inline-block">
            <input type="password" class="form-control" name="password" placeholder="Password" 
            style="margin-right: 10px;" required>
            <input type="password" class="form-control mb-2" placeholder="Confirm" required name="password_confirmation"
            style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
            
          </div>
          <input type="hidden" name="phone" value="9800985145">
          <input type="hidden" name="address" value="Imadol">
          <input type="hidden" name="dob" value="1998/12/19">
          <input type="hidden" name="gender" value="M"> 
          <h6 style="font-size:small;">Use 8 or more characters with a mix of letters, numbers & symbols
          </h6><br>
          <b><a href="{{URL::to('login')}}" style="font-size:small; text-decoration: none;">Sign in instead</a></b>
          <button type="submit" class="btn btn-primary "
          style="float: right; padding: 6px 30px;">
            Next
          </button>
        </form>
      </div>
      <div class="col-md-4">
          <img src="/image/default-avatar.png" alt="" style="width: 150px; transform: translate(50px, 80px);">
      </div>
    </div>  
    
  </div>
</body>
</html>