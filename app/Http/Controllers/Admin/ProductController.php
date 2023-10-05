<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Image;
use Session;
use Auth;
class ProductController extends Controller
{
    public function products(){
        $products = Product::with('category')->get()->toArray();
        return view('admin.products.products')->with(compact('products'));
    }
 
    public function updateProductStatus(Request $request, Product $Product)
    {
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=="Active"){
                $status="0";
            }else{
                $status="1";
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Product deleted successfully!');
    }

    public function deleteProductImage($id){
            $productImage = product::select('product_video')->where('id',$id)->first();
            $product_image_path = 'front/images/categories/';
            if(file_exists($product_image_path.$productImage->product_video)){
                unlink($product_image_path.$productImage->product_video);
            }
            Product::where('id',$id)->update(['product_video'=>'']);
            return redirect()->back()->with('success_message','product image have been deleted suceesfully!');
    }

    public function addEditProduct(Request $request ,$id=null){
        $getCategories = Category::getCategories();
        if($id==""){
            $title = "Add Product";
            $product = new Product;
            $message = "Product added successfully!";
        }else{
            $title = "Edit Product";
            $product = Product::find($id);
            $message = "Product updated Successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'category_id'=>'required',
                'product_name'=> 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'product_code'=> 'required|regex:/^[\w-]*$/|max:30',
                'product_price'=> 'required|numeric',
                'product_color'=> 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'product_quantity'=> 'required|numeric',
            ];
        $customMessages = [
            'category_name.required'=>'Category is required',
            'product_name.required'=>'Product is name required',
            'product_name.regex'=>'Valid Product name is required',
            'product_code.required'=>'Product code is name required',
            'product_code.regex'=>'Valid Product code name is required',
            'product_price.required'=>'Product price is required',
            'product_price.numeric'=>'Valid Product price is required',
            'product_color.required'=>'Product color is required',
            'product_color.regex'=>'Valid Product color is required',
            'product_quantity.required'=>'Product quantity is required',
            'product_quantity.numeric'=>'Valid Product quantity is required'
        ];
        $this->validate($request,$rules,$customMessages);
        $imagename='';
        if($request->hasfile('product_video')){
            $image_tmp = $request->file('product_video');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $imagename=rand(111,99999).'.'.$extension;
                $imagepath='front/images/products/'.$imagename;
                Image::make($image_tmp)->save($imagepath);
                $product->product_video = $imagename ;
            }       
        }    
        if(!isset($data['product_discount'])){
            $data['product_discount'] = 0 ;
        }
        if(!isset($data['product_weight'])){
            $data['product_weight'] = 0 ;
        }
        $product->category_id = $data['category_id']; 
        $product->product_name = $data['product_name']; 
        $product->product_code = $data['product_code']; 
        $product->product_price = $data['product_price']; 
        $product->product_color = $data['product_color']; 
        $product->product_discount = $data['product_discount']; 
        if(!empty($data['product_discount'])&& $data['product_discount']>0){
            $product->discount_type = 'product_discount'; 
            $product->final_price = $data['product_price'] - ($data['product_price'] * $data['product_discount'])/100; 
        }else{
            $getCategoryDiscount = Category::select('category_discount')->where('id',$data['category_id'])->first();
            if($getCategoryDiscount->category_discount == 0){
                $product->discount_type = "";
                $product->final_price = $data['product_price'];
            }
        }
        $product->product_weight = $data['product_weight']; 
        $product->description = $data['description']; 
        $product->product_quantity = $data['product_quantity']; 
        $product->status = 1;
        $product->save();
        return redirect('admin/products')->with('success_message',$message);
        }
        return view('admin.products.add_edit_product')->with(compact('title','getCategories','product'));
    }

}
