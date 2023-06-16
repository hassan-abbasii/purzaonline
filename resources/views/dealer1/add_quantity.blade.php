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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="{{asset('css/admin/dashboard.css')}}" rel="stylesheet">

    
    <title>Edit Spare Part</title> 
</head>
<body>
   
 <div>
@include('dealer1.header', ['shop' => $shop])
 </div>
<div>
@include('dealer1.sidebar', ['shop' => $shop])
  <div class="home ">
 <div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-cart"></i> Edit Spare Part</h1>
                         <p style="color: #adb5bd;">(Edit The details to Update Record.)</p>
                       </div>
                       <div>
                        <a href="{{route('allproducts')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-cart"></i> View All Products</a>
</div>
        
                    </div>
<div class="aboutdiv-heading-border4"></div>

                    <div class="row justify-content-center">
<div class="col-md-5 mt-2 mx-2">
  <div class="car-form">
   
  <h2>Add New Spare Part</h2>
  <div class="aboutdiv-heading-border4"></div>
  <form method="post" action="{{route('update-quantity',['id'=>$product1->id])}} " id="input-form" enctype="multipart/form-data">
   @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif

               @csrf
               @method('PUT')
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
   
   
   <div class="form-group">
     <label>Edit Product Quantity</label>
     <input type="number" name="quantity" min="1" value="{{$product1->quantity}}" class="form-control w-75" id="quantity">
    
   </div>
  
 
 
   
<br>
<div class="aboutdiv-heading-border4"></div>
 
  <div class="global-flex1 justify-content-end">
    <div class="  mt-3"></div>
    <button class="btn btn-primary " type="Submit">Update Quantity</button>
  </div>
</form>

<div id="error-message" style="color: red; display: none;"></div>
</div>
                    </div>
         </div>


         </div>
</div>
</div>

 <script src="{{ asset('js/admin/find.js') }}"></script>
 <!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 
 

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script>
  // Function to validate the form
 // Function to validate the form
function validateForm() {
  // Get form inputs
  var nameInput = document.getElementById('name1');
  var imageInput = document.getElementById('image');
  var quantityInput = document.getElementById('quantity');
  var actualPriceInput = document.getElementById('actualPrice');
  var sellingPriceInput = document.getElementById('sellingPrice');

  // Get error elements
  var nameError = document.getElementById('nameError');
  var imageError = document.getElementById('imageError');
  var quantityError = document.getElementById('quantityError');
  var actualPriceError = document.getElementById('actualPriceError');
  var sellingPriceError = document.getElementById('sellingPriceError');

  // Reset previous errors
  nameError.innerHTML = '';
  imageError.innerHTML = '';
  quantityError.innerHTML = '';
  actualPriceError.innerHTML = '';
  sellingPriceError.innerHTML = '';

  // Validate name (not empty)
  if (nameInput.value.trim() === '') {
    nameError.innerHTML = 'Product name is required';
    alert('Product name is required');
    return false;
  }

  // Validate image (file type)
  if (imageInput.value !== '') {
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.bmp)$/i;
    if (!allowedExtensions.exec(imageInput.value)) {
      imageError.innerHTML = 'Only image files are allowed (JPG, JPEG, PNG, GIF, BMP)';
      alert('Only image files are allowed (JPG, JPEG, PNG, GIF, BMP)');
      return false;
    }
  }

  // Validate quantity (greater than zero)
  if (quantityInput.value <= 0) {
    quantityError.innerHTML = 'Quantity must be greater than zero';
    alert('Quantity must be greater than zero');
    return false;
  }

  // Validate actual price (greater than zero)
  if (actualPriceInput.value <= 0) {
    actualPriceError.innerHTML = 'Actual price must be greater than zero';
    alert('Actual price must be greater than zero');
    return false;
  }

  // Validate selling price (greater than or equal to actual price)
  if (sellingPriceInput.value < actualPriceInput.value) {
    sellingPriceError.innerHTML = 'Selling price must be equal to or greater than the actual price';
    alert('Selling price must be equal to or greater than the actual price');
    return false;
  }

  // If all validations pass, submit the form
  return true;
}

// Add form submit event listener
var form = document.getElementById('input-form');
form.addEventListener('submit', function (event) {
  // Prevent form submission if validation fails
  if (!validateForm()) {
    event.preventDefault();
  }
});

</script>



</body>
</html>
