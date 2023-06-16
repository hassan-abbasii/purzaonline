<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZVZl6Fpdn8VaxWkHv2rV9X6+u/Q8fBH5hzkmvE3qgCYN5Q5vdTwgvWxLhJCLp9XmRFGy5hW+d73Jupkq3C1Z3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!----======== CSS ======== -->
 <link rel="stylesheet" href="{{asset('css/dealer/dealer_dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
     
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="css/admin/dashboard.css" rel="stylesheet">

    
    <title>Dealer Dashboard</title> 
</head>
<body>
   <div class="container-fluid">
 <div>
@include('dealer.header', ['shop' => $shop])
 </div>
<div>
@include('dealer.sidebar', ['shop' => $shop])
  <div class="home">
    <div class="container-fluid">
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 head1">Dashboard</h1>
                         
                    </div>
                    <div class="d-flex justify-content-center">
                      @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
                    </div>

                     <div class="row ">
                    <div class="col mx-1 mx-md-5 my-1">
                     <div class="top-inv">
                         <p>If You want to manage your shop inventory with our system, get started to manage your business, Your Products would be listed on our website and you will get connected with more customers.</p>
                         <p style="color: blue; text-align: center;">Note* You will no more receive queries for product availability and you have to maintain your catalog.</p>
                         <div class="d-flex d-flex-row justify-content-center align-items-baseline"><button class="btn btn-primary" onclick="confirmRedirect({{ $shop->id }})">
    Manage Shop Inventory <i class="bi bi-cart"></i>
  </button></div>
                     </div>
                 </div>
                 </div>
                  <div class="row justify-content-around">
            <div class="col-md-6 mx-1  my-2">
                <div class="enhance">
                  <div class="d-flex justify-content-center align-items-baseline">
                <h2 class="text-primary">Enhance Your Business <i class="bi bi-graph-up"></i></h2></div>
                <div>
                    
                  <p>You can feature your shop, We will show your shop on our homepage and you will get more customers</p>
                    <div class="d-flex justify-content-center"><button class="btn btn-primary ">Run Feature Ad <i class="bi bi-badge-ad"></i></button></div>

                </div>
            </div>
            </div>
            <div class="col-md-4 mx-1  my-2">
                <div class="enhance">
                <h2 class="text-success">Respond Queries</h2>
                <div>
                    
                  <p>Respond to customer queries for the availability of product, this will increase your walk-in customers.</p>
                    <div class="d-flex justify-content-center"><a href="{{route('allqueriesdealer')}}"><button class="btn btn-success">Respond Now <i class="bi bi-chat-three-dots"></i></button></a></div>

                </div>
            </div>
            </div>






            </div>  



</div>
</div>
</div>
 
  <!-- Bootstrap JavaScript -->
 </div>


 <script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/mechanic/shop.js') }}"></script>
   <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function confirmRedirect(shopId) {
  var confirmation = confirm("Are you sure you want to manage the shop inventory?");

  if (confirmation) {
    var url = "{{ route('manageInventory', ['id' => ':shopId']) }}";
    url = url.replace(':shopId', shopId);
    window.location.href = url;
  }
}
</script>
</body>
</html>
