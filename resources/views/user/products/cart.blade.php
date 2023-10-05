<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    <title>Cart-2</title>
    <style>
        .wid{
            width:37px;
        }
    </style>
  </head>
  <body>

    <section class="h-100 h-custom" style="background-color: #d2c9ff;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
              <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                <div class="card-body p-0">
                  <div class="row g-0">
                  @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:  </strong> {{Session::get('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @endif
                    <div class="col-lg-8">
                      <div class="p-5">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                          <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                          <h6 class="mb-0 text-muted">3 items</h6>
                        </div>
                        @if(!empty($cartContent))
                        @foreach($cartContent as $item)
                        <hr class="my-4">
      
                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                          <div class="col-md-2 col-lg-2 col-xl-2">
                            <!-- <img
                              src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img5.webp"
                              class="img-fluid rounded-3" alt="Cotton T-shirt"> -->
                          </div>
                          <div class="col-md-3 col-lg-3 col-xl-3">
                            <h6 class="text-muted">Rs.{{$item->price}}</h6>
                            <h6 class="text-black mb-0">{{$item->name}}</h6>
                          </div>
                          <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                            <button class="btn btn-link px-2 sub" data-id = "{{$item->rowId}}"
                              onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                              <i class="fas fa-minus"></i>
                            </button>
      
                            <input id="form1" min="0" name="quantity" value="{{$item->qty}}" type="text"
                              class="form-control form-control-sm wid" />
      
                            <button class="btn btn-link px-2 add" data-id = "{{$item->rowId}}"
                              onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                          <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                            <h6 class="mb-0">{{$item->price * $item->qty}}</h6>
                          </div>
                          
                          <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                            <button class="text-muted"  onclick="deleteItem('{{$item->rowId}}')"><i class="fas fa-times"></i></button>
                          </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="pt-5">
                          <h6 class="mb-0"><a href="{{url('user/product')}}" class="text-body"><i
                                class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 bg-grey">
                      <div class="p-5">
                        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                        <hr class="my-4">
      
                     <!-- <div class="d-flex justify-content-between mb-4">
                          <h5 class="text-uppercase">items 3</h5>
                           <h5>{{Cart::subtotal()}}</h5> 
                        </div> 
       -->
                            <!-- <h5 class="text-uppercase mb-3">Shipping</h5>
        
                            <div class="mb-4 pb-2">
                            <select class="select">
                                <option value="1">Standard-Delivery-</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="4">Four</option>
                            </select>
                            </div>
        
                            <h5 class="text-uppercase mb-3">Give code</h5>
        
                            <div class="mb-5">
                            <div class="form-outline">
                                <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                                <label class="form-label" for="form3Examplea2">Enter your code</label>
                            </div>
                            </div> -->
      
                        <hr class="my-4">
      
                        <div class="d-flex justify-content-between mb-5">
                          <h5 class="text-uppercase">Total price</h5>
                          <h5>{{Cart::subtotal()}}</h5>
                        </div>
      
                        <button type="button" class="btn btn-dark btn-block btn-lg"
                          data-mdb-ripple-color="dark">Checkout</button>
      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>

<script>
$('.add').click(function() {
    var qtyElement = $(this).prev(); // Qty Input
    var qtyValue = parseInt(qtyElement.val());
    if (qtyValue < 10) {
        var rowId = $(this).data('id');
        
        // Make an AJAX request to check the available quantity
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'check-quantity',
            type: 'POST',
            data: {
                rowId: rowId
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === true) {
                    var availableQty = response.message; // Access the "message" key
                    if (qtyValue < availableQty) {
                        qtyElement.val(qtyValue + 1);
                        var newQty = qtyElement.val();
                        updateCart(rowId, newQty);
                    } else {
                        alert('Sorry, the requested quantity is not available. Please try a quantity less than ' + availableQty + '.');
                    }
                } else {
                    alert('Failed to check quantity.');
                }
            },
            error: function(xhr, status, error) {
                // Handle any AJAX errors here, e.g., alert("Error: " + error);
            }
        });
    }
});
$('.sub').click(function(){
      var qtyElement = $(this).next(); 
      var qtyValue = parseInt(qtyElement.val());
      if (qtyValue > 1) {
          var rowId = $(this).data('id');
          qtyElement.val(qtyValue-1);
          var newQty = qtyElement.val();
          updateCart(rowId,newQty)
      }        
  });



  function updateCart(rowId, qty) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'update-cart',
        type: 'post',
        data: {
          rowId: rowId, 
          qty: qty },
        dataType: 'json',
        success: function (response) {
            if (response.status == true) {
              // alert(response.message);
                location.reload();
              } else {
                alert(response.message);
                location.reload();
            }
        }
    });
}

function deleteItem(rowId) {
    if (confirm("Are you sure you want to remove this item from your cart?")) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'delete-item',
            type: 'POST',
            data: {
                rowId: rowId
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === true) {
                    alert(response.message);
                    // Reload the page after successful deletion
                    location.reload();
                } else {
                    alert(response.message);
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                // Handle any AJAX errors here, e.g., alert("Error: " + error);
            }
        });
    }
}



</script>