<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function showdashboard(){
        $products = Product::with('category')->get()->toArray();
        return view('user.products.product')->with(compact('products'));
    }
    
}
