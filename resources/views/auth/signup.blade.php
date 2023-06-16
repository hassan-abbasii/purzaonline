<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('css/auth/loginreg.css') }}">
         
    <title>Signup Form</title>
</head>
<body>
    
    <div class="container1">
        <div class="forms ">
            <!-- Registration Form -->
            <div class="form signup">
                <span class="title" style="font-size: 47px; font-weight: bold;">Registration</span><br>

                <form id="signup-form" action="{{route('signup-user')}}" method="post">
               @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
                <!-- <div class="input-field"> -->
                    <!-- <select class="form-select" aria-label="Default select example" id="role">
                        <option selected>Register as a</option>
                        <option value="1">Car Owner</option>
                        <option value="2">Mechanic</option>
                        <option value="3">Spare Parts Dealer</option>
                   </select> -->
                   
 @csrf
                    <div class="input-field ">
                        <input type="text"   id="name" name="name" type="text" placeholder="Enter your name"  required>
                        <i class="uil uil-user"></i>
                    
                    </div>
                    <div class="input-field  ">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"    placeholder="Enter your Email" required>
                        <i class="bi bi-envelope-at"></i>
                       
                    </div>
                    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                   <div class="input-field">
                        <input type="password" class="password" name="password" id="password" placeholder="Create your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    

                    
                    <div class="form-check form-group"><br>
                    <label style="font-weight: bold;">Register as: </label><br><br>
                        <label class="form-check-label carowner-checkbox" >
                        <input class="form-check-input form-control" type="radio" name="role" id="carowner" value="car_owner" checked>
                            &nbsp;Car Owner
                        </label><br>
                        <label class="form-check-label" >
                        <input class="form-check-input form-control" type="radio" name="role" id="mechanic" value="mechanic">
                            &nbsp;Mechanic
                        </label><br>
                        <label class="form-check-label">
                        <input class="form-check-input form-control" type="radio" name="role" id="mechanic" value="dealer">
                            &nbsp;Parts Dealer
                        </label>
                    </div>
                    

                    <div class="input-field button">
                        <input type="submit" value="Signup">
                    </div>
                </form>
 
<div id="error-message" style="color: red; display: none;"></div>
                <div class="login-signup">
                    <span class="text">Already a member?
                        <a href="login" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="js/auth/loginreg.js"></script>
    <script>
    const form = document.getElementById('signup-form');
    const name = document.getElementById('name');
    const password = document.getElementById('password');

    form.addEventListener('submit', (event) => {
        let errors = [];

        // Validate name
        const nameRegex = /^[a-zA-Z ]+$/;
        if (!name.value.match(nameRegex)) {
            errors.push('Name should only contain alphabets and spaces.');
        }

        // Validate password length
        if (password.value.length < 8) {
            errors.push('Password should be at least 8 characters long.');
        }

        // If there are errors, prevent form submission and display errors
        if (errors.length > 0) {
            event.preventDefault();

            const errorElement = document.getElementById('error-message');
            errorElement.innerHTML = errors.join('<br>');
            errorElement.style.display = 'block';
        }
    });
</script>
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
</body>
</html>

