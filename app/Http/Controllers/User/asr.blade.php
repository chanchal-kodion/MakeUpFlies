$('.add, .sub').click(function() {
    var qtyElement = $(this).siblings('.quantity'); // Qty Input
    var qtyValue = parseInt(qtyElement.val());
    var rowId = $(this).data('id');

    if ($(this).hasClass('add')) {
        // Increment button clicked
        if (qtyValue < 10) {
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
                        var availableQty = response.message;
                        if (qtyValue < availableQty) {
                            qtyElement.val(qtyValue + 1);
                            var newQty = qtyElement.val();
                            updateCart(rowId, newQty);
                        } else {
                            alert('Sorry, there are only ' + availableQty + ' items available for this product.');
                        }
                    } else {
                        alert('Failed to check quantity.');
                    }
                },
                error: function(xhr, status, error) {              
                }
            });
        }
    } else if ($(this).hasClass('sub')) {
        // Decrement button clicked
        if (qtyValue > 1) {
            qtyElement.val(qtyValue - 1);
            var newQty = qtyElement.val();
            updateCart(rowId, newQty);
        }
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



  public function checkQuantity(Request $request)
    {
        $rowId = $request->input('rowId');
        // $rowId = $request->rowId;
        $qty = $request->qty;
        
        // Retrieve the item from the database using the rowId
        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);

        if (!$itemInfo) {
            // Item not found, you can handle this case accordingly
            return response()->json(['status' => false, 'message' => 'Item not found']);
        }

        // Check if the requested quantity is less than or equal to the available quantity
        // Change this to the quantity you want to add
        if ($qty <= $product->product_quantity) {
            return response()->json(['status' => true, 'message' => "$product->_quantity"]);
        } else {
            return response()->json(['status' => false, 'message' => 'Requested quantity is not available']);
        }
    }