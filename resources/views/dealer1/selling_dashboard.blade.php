<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <!-- Font Awesome CSS -->
  
    <!----======== CSS ======== -->
 <link rel="stylesheet" href="{{asset('css/mechanic/mechanic_profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
     <link rel="stylesheet" href="{{asset('css/dashboard1.css')}}">
    <link rel="stylesheet" href="{{asset('css/dealer/dealer_dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
    
    <!----===== Boxicons CSS ===== -->
   
   
    <title>Product Detail</title> 
</head>
<body>
   
 @include('dealer1.header', ['shop' => $shop])
 </div>
<div>
@include('dealer1.sidebar', ['shop' => $shop])
  <div class="home">
 <div class="container-fluid">
  
               <div class="d-sm-flex align-items-center justify-content-between  ">
                       <div class="global-flex-new1">
                        <h1 class="h3 mb-0 text-gray-800 head1"><i class="bi bi-credit-card"></i> Selling dashboard</h1>
                         <p style="color: #adb5bd;">(Detail of Product )</p>
                       </div>
                        <a href="{{route('allsales')}}" class=" d-sm-inline-block btn mt-2 btn-primary shadow-sm"><i
                                class="bi bi-cart"></i> View All Sales</a>
                       <div class="global-flex-new justify-content-center">
     
     @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('fail'))
               <div class="alert alert-danger">{{Session::get('fail')}}</div>
               @endif
  
         </div>
</div>


 
<div class="row justify-content-between">
  <div class="col-md-8 ">
    <div class="mt-3 sell-search" >
      <div class=" mt-3 global-flex1 justify-content-center">
     
    <input type="text" class="form-control w-50" name="" id="search" placeholder=" filter here..">
    <div>
    
    </div>
  </div>
  <p>Click on table Row to add item in selling list</p>
  </div>
     <div class=" reserve-head1  mt-1">
            <div>
            <table class="table table-striped thead-dark ">
                <thead class="bg-dark text-light">
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Selling Price</th>
                    <th>Car-Detail</th>
                    <th>Quantity</th>
                     <th>Condition</th> 
                     <th>Brand</th>                 
                    
                    
                </thead>
              <tbody>
            <tr onclick="addToSellingList(this)">
              @forelse($record as $a)
                <td>{{$a->id}}</td>
                <td>{{$a->name}}</td>
                <td>{{$a->products->name}}</td>
                <td>{{$a->sellingPrice}}</td>
                <td>[{{$a->car->make}}, {{$a->car->model}}, {{$a->car->variant}}]</td>
                <td>{{$a->quantity}}</td>
                <td>{{$a->condition}}</td>
                <td>{{$a->brand}}</td>
            </tr>
           @empty
           <tr ><td colspan="8">No Record To Show</td></tr>
           @endforelse
        </tbody>
                
            </table>
        </div>
        </div>
  </div>
  <div class="col-md-4 mt-1 my-3" >
    <div class="sell-qty" style="min-height: 480px;">
     <h2>Selling List</h2>
     <div class="prod-sell">
       <div id="selling-list">
      <!-- Selling list items will be added dynamically here -->
    </div>
    

    </div>
     
     <div class="bill-total">
        
       <div class="global-flex justify-content-center">
        <form id="sell-product-form" action="{{route('sellproduct')}}" method="post">
          @csrf
          <input type="hidden" value="" name="productid"  id="productid">
          <input type="hidden" value="" name="quantity" id="quantity">

       <button class="btn w-75" type="submit" id="sell-product">Sell</button>
     </form>
     </div>
     </div>
    
  </div>
</div>

</div>


             
            






</div>
</div>
</div>
<script type="text/javascript">
  const sellProductForm = document.getElementById('sell-product-form');
const productIdField = document.getElementById('productid');
const quantityField = document.getElementById('quantity');

sellProductForm.addEventListener('submit', function(event) {
  if (productIdField.value.trim() === '' || quantityField.value.trim() === '') {
    event.preventDefault(); // Prevent form submission if fields are empty
    alert('Please add Product to Selling list to sell.');
  }
});
</script>

<!-- Include custom JavaScript file -->
<script src="{{ asset('js/alert.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  const addToSellingList = (row) => {
        const productId = row.getAttribute('data-row-id');
      
const productIid = row.cells[0].textContent;
   
    const productName = row.cells[1].textContent;
    const sellingPrice = row.cells[3].textContent;
    const quantity = parseInt(row.cells[5].textContent);
     if (quantity === 0) {
    alert('Sorry, Item Out Of Stock.');
    return;
  }

    const sellingList = document.getElementById('selling-list');

    // Check if the product already exists in the selling list
    const existingProduct = sellingList.querySelector(`.prod-sell[data-product-id="${productId}"]`);
    if (existingProduct) {
      return; // Exit the function if the product already exists
    }

    var pid=document.getElementById('productid');
    var qty=document.getElementById('quantity');
    pid.value=productIid;
    qty.value=1;
    
    console.log('quantity a g');
    console.log(pid);
    console.log('quantity a g');
    console.log(qty);

    const sellingListItem = document.createElement('div');
    sellingListItem.classList.add('prod-sell');
    sellingListItem.setAttribute('data-product-id', productId);
    sellingListItem.innerHTML = `
      <div>
        <div class="global-flex d-flex justify-content-center">
          <label>${productName}</label>
        
          <label class="mx-2">Rs. ${sellingPrice}</label>
        </div>
        <div class="global d-flex justify-content-center align-items-baseline">
          <div class="input-group w-75">
            <div class="input-group-prepend">
              <span class="input-group-text mx-1 minus-btn" data-quantity="1"><i class="bi bi-dash-lg"></i></span>
            </div>
            <input type="number" class="form-control p-1 quantity-input" placeholder="Quantity" aria-label="Amount (to the nearest dollar)" min="1" disabled max="${quantity}" value="1">
            <div class="input-group-append">
              <span class="input-group-text mx-1 plus-btn" data-quantity="${quantity}"><i class="bi bi-plus-lg"></i></span>
            </div>
          </div>
         
        </div>
         <div class="cancel-btn" data-product-id="${productId}"><button class="btn btn-sm btn-danger mt-2">cancel</button</div>
      </div>`;

    sellingList.appendChild(sellingListItem);

    // Add event listeners to the plus and minus buttons
    const plusBtn = sellingListItem.querySelector('.plus-btn');
    const minusBtn = sellingListItem.querySelector('.minus-btn');
    const quantityInput = sellingListItem.querySelector('.quantity-input');
    const cancelBtn = sellingListItem.querySelector('.cancel-btn');

    plusBtn.addEventListener('click', function() {
      const maxQuantity = parseInt(this.getAttribute('data-quantity'));
      let currentQuantity = parseInt(quantityInput.value);

      if (currentQuantity < maxQuantity) {
        currentQuantity++;

        quantityInput.value = currentQuantity;
        qty.value=currentQuantity;
    
    console.log('quantity navia g');
    console.log(qty);
      }
    });

    minusBtn.addEventListener('click', function() {
      let currentQuantity = parseInt(quantityInput.value);

      if (currentQuantity > 1) {
        currentQuantity--;
        quantityInput.value = currentQuantity;
        qty.value=currentQuantity;
      }
    });

    quantityInput.addEventListener('change', function() {
      let currentQuantity = parseInt(quantityInput.value);

      if (currentQuantity < 1) {
        quantityInput.value = 1;
      } else if (currentQuantity > quantity) {
        quantityInput.value = quantity;
        qty.value=quantity;
      }
    });

    cancelBtn.addEventListener('click', function() {
      sellingList.removeChild(sellingListItem);
      pid.value="";
      qty.value="";
      console.log('EveryThing Reset');
      console.log(pid);
      console.log(qty);

    });
  }
   const updateAmount = () => {
    const sellingList = document.getElementById('selling-list');
    const amountLabel = document.getElementById('amount');
    const productList = sellingList.getElementsByClassName('prod-sell');
    let totalAmount = 0;

    for (let i = 0; i < productList.length; i++) {
      const product = productList[i];
      const sellingPrice = parseFloat(product.querySelector('.selling-price').textContent);
      const quantity = parseInt(product.querySelector('.quantity-input').value);
      const productAmount = sellingPrice * quantity;

      totalAmount += productAmount;
    }

    if (totalAmount === 0) {
      amountLabel.textContent = 'Rs. 0'; // Set amount to 0 if no products in the selling list
    } else {
      amountLabel.textContent = 'Rs. ' + totalAmount.toFixed(2); // Update the amount with the calculated total
    }
  }

  const searchInput = document.getElementById('search');
  const table = document.querySelector('.table');
  const tableRows = table.querySelectorAll('tbody tr');
  tableRows.forEach(function(row) {
    row.addEventListener('click', function(event) {
      if (event.target.tagName !== 'TD') {
        return; // Ignore clicks on inner elements within the row
      }

      const searchValue = searchInput.value.toLowerCase();

      if (searchValue && !rowMatchesSearch(row, searchValue)) {
        return; // Ignore the row if it doesn't match the search criteria
      }

      if (row.classList.contains('selected')) {
        row.classList.remove('selected'); // Deselect the row if it's already selected
      } else {
        row.classList.add('selected'); // Add the 'selected' class to indicate the row is selected
        addToSellingList(row);
      }
    });
  });

  searchInput.addEventListener('keyup', function(event) {
    const searchValue = event.target.value.toLowerCase();

    tableRows.forEach(function(row) {
      if (!rowMatchesSearch(row, searchValue)) {
        row.style.display = 'none';
      } else {
        row.style.display = '';
      }
    });
  });

  function rowMatchesSearch(row, searchValue) {
    const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
    const category = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

    return productName.includes(searchValue) || category.includes(searchValue);
  }
</script>
 
















 <script>
    // Get the input element
   // Get the input element
var input = document.getElementById("myInput");

// Add an event listener for input changes
input.addEventListener("input", function() {
    var filter = input.value.toLowerCase();

    // Get all the card elements
    var cards = document.getElementsByClassName("app-card");

    // Loop through the cards and hide/show based on the input value
    for (var i = 0; i < cards.length; i++) {
        var card = cards[i];
        var name = card.getElementsByClassName("nameee")[0].textContent.toLowerCase();
        var status = card.getElementsByClassName("stttatus")[0];
        var engine = card.getElementsByClassName("s000")[0];
        var service1 = card.getElementsByClassName("s111")[0].textContent.toLowerCase();
        var service2 = card.getElementsByClassName("s222")[0].textContent.toLowerCase();
        var date = card.getElementsByClassName("dateee")[0].textContent.toLowerCase();

        if (
            name.includes(filter) ||
            status.textContent.toLowerCase().includes(filter) ||
            engine.textContent.toLowerCase().includes(filter) ||
            service1.includes(filter) ||
            service2.includes(filter) ||
            date.includes(filter)
        ) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    }
});
</script>
 

</body>
</html>
