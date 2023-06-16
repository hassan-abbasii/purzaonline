<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <title>Mechanic Appointment</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  
    <link rel="stylesheet" type="text/css" href="{{asset('css/products.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('css/browse_catalog.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/product_detail.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<style type="text/css">
  select{
    background-color: #e5e5e5;
    width: 80%;
    height: 40px;
    border-radius: 20px;
}
</style>

</head>
<body>
    <div>
      @if(session()->has('loginId'))
    @include('header_session')
@else
    @include('header')
@endif
    </div>  
     <div class="container-fluid justify-content-between browse-catalog1" >
  <div class="row ">
    <div class="col-md-12 ">
      <div class="global-flex1">
      <div class="browse-top global-flex ">
        <div class="global-flex align-items-baseline">
        <img src="{{asset($shop->image)}}" alt="store">
        <a style="text-decoration: none;" href="{{route('shop_details_dealer',['id' => $shop->id])}}"><h2>{{$shop->name}}</h2></a>
        <p>({{$reviewCount}})&nbsp; @php
    $rating = intval($averageRating);
@endphp

@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star" style="color: gold;"></i>
    @else
        <i class="fa fa-star" style="color: grey;"></i>
    @endif
@endfor&nbsp;{{$averageRating}}</p>
        <div><a href="{{route('getdirection',['id' => $shop->id])}}"><button class="mx-2 btn btn-primary">Get Direction To Store <i class="bi bi-geo-alt-fill"></i></button></a>
  </div>  
</div>
     
         
      </div>
    </div>
       

      </div>
    </div>
    <div class="global-flex-new justify-content-center w-50">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  </div>
  <div class="row mx-1 mt-md-3 mt-sm-2 mx-3 mt-1 ml-2 justify-content-around">
  	 
    <div class="col-md-3 mt-md-3 mt-sm-2 mt-2 content content1  ">
      
      <h2>Reserve Product Now</h2>
      <form method="post" action="{{route('reserve')}}" >
         @csrf
      <label>Enter Quantity To Reserve</label><br>
      <input class="w-75" type="number" name="quantity" min="1" max="{{$record->quantity}}" required><br><br> 
       <input type="hidden" name="shop_id" value="{{$shop->id}}">
       <input type="hidden" name="prod_id" value="{{$record->id}}">
      <button class="btn btn-primary">Reserve </button>
      <p>Note*  Reservation would be Made for only 24-hours.</p>
    </form>
    
    </div>


    <div class="col-md-7 mx-1 mt-md-3 mt-sm-2 mt-2 content content2    ">
      <h2>Product Description</h2>
      <div class="global-flex">
        <div class="w-50 content2-side"   style="max-height: 300px;">
         <div class=" mt-2 ">
           
      <img src="{{asset($record->image)}}" alt="product image">
      <div class="global-flex-col  mt-3 ">
        <div class="global-flex1 justify-content-around iconp " style="font-family: 'poppins', sans-serif;">
          <p>Price</p>
          <p>Rs. {{$record->sellingPrice}} </p>
        </div>
         
      </div>
     </div>
    </div>
     <div class="global-flex-col mx-5 content2-side1" >
            <table class="text-center table
            ">
              <tr class="global-flex justify-content-around">
                <td>Name</td>&nbsp;&nbsp;
                <td>{{$record->name}}</td>
              </tr>
              <tr class="global-flex justify-content-around" >
                <td>Product</td>&nbsp;&nbsp;
                <td>{{$record->products->name}}</td>
              </tr>
              <tr class="global-flex justify-content-around">
                <td>Quantity</td>&nbsp;&nbsp;
                <td>{{$record->quantity}}</td>
              </tr>
              <tr class="global-flex justify-content-around">
                <td>Make</td>&nbsp;&nbsp;
                <td>{{$record->car->make}}</td>
              </tr>
              <tr class="global-flex justify-content-around">
                <td>Model</td>&nbsp;&nbsp;
                <td>{{$record->car->model}}</td>
              </tr>
              <tr class="global-flex justify-content-around">
                <td>Variant</td>&nbsp;&nbsp;
                <td>{{$record->car->variant}}</td>
              </tr>
              <tr class="global-flex justify-content-around">
                <td>Condition</td>&nbsp;&nbsp;
                <td>{{$record->condition}}</td>
              </tr>
              <tr class="global-flex justify-content-around">
                <td>Brand</td>&nbsp;&nbsp;
                <td>{{$record->brand}}</td>
              </tr>
            </table>
    </div>
       
    </div>



     
  </div>
</div><div>
  <div class="mt-5">
 
@include('footer');
  
</div>
  </div>

      
  <script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  

</body>
</html>