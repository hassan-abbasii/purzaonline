<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
 
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" /> 
    <link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
  crossorigin="anonymous">
<link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="{{asset('css/mechanic/dashboard.css')}}" rel="stylesheet">
  <link href="{{asset('css/mechanic/mechanic_profile.css')}}" rel="stylesheet">

    
    <title>Run Feature Ad</title> 
</head>
<body>
   
 <div>
@include('mechanic.header', ['shop' => $shop])
 </div>
<div>
@include('mechanic.sidebar', ['shop' => $shop])
 
  <div class="home">
 <div class="container-fluid">
  
               <div class="d-sm-flex align-items-center justify-content-between  ">
                       <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-badge-ad"></i> Payment of Feature Ad</h1>
                         <p style="color: #adb5bd;"></p>
                       </div>
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
                         
                    </div>
                     <!-- Content Row -->
                   
<div class="aboutdiv-heading-border4"></div>
<br>
 
             

             <!--Card Form-->       
<div class="container">
    <div class='row'>
      <div class='col-md-4'></div>
      <div class='col-md-4'>
        <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
        <form accept-charset="UTF-8" action="{{route('payment')}}" class="require-validation"
          data-cc-on-file="false"
          data-stripe-publishable-key="pk_test_51KNK4FGb9p5ZjP9iDnGJnVXbGREGtWdF0IkWhWzQ6XNTGDe52JDBEHhl9PISVyKxoqHcNhHr6z5cPShCeoFOmw4300MHN4rB7D"
          id="payment-form" method="post">
          @csrf
          <div class='form-row'>
            <div class='col-xs-12 form-group required'>
              <label class='control-label'>Card Holder Name</label> <input required
                class='form-control' size='4' type='text' placeholder="Enter Card Holder Name">
            </div>
          </div>
          <input type="hidden" name="image" value="{{$imagePath}}">
          <input type="hidden" name="adid" value="{{$adid}}">
          <input type="hidden" name="detail" value="{{$detail}}">
          <div class='form-row'>
            <div class='col-xs-12 form-group card required'>
              <label class='control-label'>Card Number</label> <input required
                autocomplete='off' class='form-control card-number' size='20'
                type='text' placeholder="Enter Card number">
            </div>
          </div>
          <div class='form-row'>
            <div class='col-xs-4 form-group cvc required'>
              <label class='control-label'>CVC</label> <input required
                autocomplete='off' class='form-control card-cvc'
                placeholder='CVV' size='4' type='text'>
            </div>
            <div class='col-xs-4 form-group expiration required'>
              <label class='control-label'>Expiration</label> <input
                class='form-control card-expiry-month' id="expm" placeholder='MM' required size='2'
                type='text'>
            </div>
            <div class='col-xs-4 form-group expiration required'>
              <label class='control-label'>YEAR</label> <input
                class='form-control card-expiry-year' id="expy" placeholder='YYYY' required
                size='4' type='text'>
            </div>
          </div>
          <!-- <div class='form-row'>
            <div class='col-md-12'>
              <div class='form-control total btn btn-info'>
                Total: <span class='amount'>$300</span>
              </div>
            </div>
          </div> -->
          <div class='form-row'>
            <div class='col-md-12 form-group'>
              <button class='form-control btn btn-primary submit-button'
                type='submit' style="margin-top: 10px;">Confirm</button>
            </div>
          </div>
          <div class='form-row'>
            <div class='col-md-12 error form-group hide'>
              <div class='alert-danger alert'>Please correct the errors and try
                again.</div>
            </div>
          </div>
        </form>
        @if ((Session::has('success-message')))
        <div class="alert alert-success col-md-12">{{
          Session::get('success-message') }}</div>
        @endif @if ((Session::has('fail-message')))
        <div class="alert alert-danger col-md-12">{{
          Session::get('fail-message') }}</div>
        @endif
      </div>
      <div class='col-md-4'></div>
    </div>
  </div>


 <!--Card Form--> 
         </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-1.12.3.min.js"
    integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
    crossorigin="anonymous"></script>
  <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    crossorigin="anonymous"></script>
  <!-- ... your HTML code ... -->

<script>
  $(function() {
    var $form = $("#payment-form");

    $form.on('submit', function(e) {
      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }
    });

    function stripeResponseHandler(status, response) {
      if (response.error) {
        $('.error')
          .removeClass('hide')
          .find('.alert')
          .text(response.error.message);

        // Show alert message
        alert('Error: ' + response.error.message);
      } else {
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

        // Check expiration date
        var currentYear = new Date().getFullYear();
        var currentMonth = new Date().getMonth() + 1; // Months are zero-based, so adding 1

        var expirationYear = parseInt($('#expy').val());
        var expirationMonth = parseInt($('#expm').val());

        if (expirationYear < currentYear || (expirationYear === currentYear && expirationMonth <= currentMonth)) {
          // Expiration date is not valid
          // Show alert message
          alert('Invalid expiration date. Please enter a future date.');
        } else {
          // Expiration date is valid
          console.log(token);
          $form.get(0).submit();
        }
      }
    }
  })
</script>

<!-- ... rest of your HTML code ... -->

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{ asset('js/admin/find.js') }}"></script>
 
</body>
</html>
