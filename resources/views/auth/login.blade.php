<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('css/auth/loginreg.css') }}">
    

    <title>Login</title>
     
</head>

<body>
      
     

    <div class="container" style="height: calc(100vh - 70px); overflow-y: auto;">
        <div class="">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form action="{{route('login-user')}}" method="post">
                     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
                    @csrf
                    <div class="input-field">
                        <input type="email" id="email" name="email"  
                            placeholder="Enter your Email" value="{{ old('email') }}"  required>
                        <i class="bi bi-envelope-at"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="password" placeholder="Enter your password" required>
                        <i class="bi bi-key icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>

                        <a href="forgotpassword.php" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Login"></a>
                    </div>
                    
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="signup" class="text signup-link">Signup Now</a>
                    </span>
                </div>
            </div>

        </div>
    </div>
    </div>

   <script src="js/auth/loginreg.js"></script>
   <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
</body>

</html>