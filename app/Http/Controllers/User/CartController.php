<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $products = Product::find($request->id);
        if($products->product_quantity > 0){
        if($products == null){
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        if(Cart::count() > 0){
            $cartcontent = Cart::content();
            $productAlreadyExists = false;
            foreach ($cartcontent as $item){
                if($item->id == $products->id){
                $productAlreadyExists = true;
                }
            }
            
            if($productAlreadyExists == false){
            Cart::add($products->id, $products->product_name, 1, $products->product_price);
            $status = true;
            $message = $products->product_name . ' added in cart';
            }else{
                $status = false;
                $message = $products->product_name . ' already added in cart';
            }

        }else{
            Cart::add($products->id, $products->product_name, 1, $products->product_price);
            $status = true;
            $message = $products->product_name . ' added in cart';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }else{
        return response()->json(['status' => false , 'message' => 'This product is currently out of stock']);
    }
    }
    
    public function cart(){
        $cartContent = Cart::content();
        $data['cartContent'] = $cartContent;
        return view('user.products.cart',$data);   
    }

    public function updateCart(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;
        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);
        if($product->product_quantity > 0){
        if($qty > $product->product_quantity){
            $status = false;
            $message = "Requested product quantity is not available.Please decrease the quantity!";
        }else{
            Cart::update($rowId,$qty);
            $status = true;
            $message = "Cart updated Successfully!";
        }
    }else{
        Cart::update($rowId,$qty);
        $status = false;
        $message = 'Product is not available at the moment!';
    }
        Cart::update($rowId,$qty);
        return response()->json(['status' => false, 'message' => $message, 'product'=> $product]);

    }

    public function deleteItem(Request $request){
        $rowId = $request->input('rowId');
        $itemInfo = Cart::get($rowId);

        if ($itemInfo == null) {
            $message = "Item not found in cart!";
            return response()->json(['status' => false, 'message' => $message]);
        }

        Cart::remove($rowId);
        $message = "Item removed from cart!";
        return response()->json(['status' => true, 'message' => $message]);
    }

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
            return response()->json(['status' => true, 'message' => $product->product_quantity]);
        } else {
            return response()->json(['status' => false, 'message' => 'Requested quantity is not available']);
        }
    }
}


