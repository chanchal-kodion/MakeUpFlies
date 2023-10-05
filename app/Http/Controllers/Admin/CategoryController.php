<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\AdminsRole;
use Session;
use Image;
use Auth;
class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::with('parentcategory')->get();
        $categoriesmodulecount = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->count();
        $CategoriesModule = array();
        if(Auth::guard('admin')->user()->type=="admin"){
            $categoriesModule['view_access'] = 1 ;
            $categoriesModule['edit_access'] = 1 ;
            $categoriesModule['full_access'] = 1 ;
        }else if($categoriesmodulecount == 0){
            $message = "This feature is disabled for you!";
            return redirect('admin/dashboard')->with('error_message',$message); 
        }else{
            $CategoriesModule =  AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->first()->toArray();
        }
        return view('admin.categories.categories')->with(compact('categories','categoriesModule'));
    }

    public function updateCategoryStatus(Request $request, Category $Category)
    {
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=="Active"){
                $status="0";
            }else{
                $status="1";
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }

    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Category deleted successfully!');
    }

    public function addEditCategory(Request $request , $id = null)
    {
        $getCategories = Category::getCategories();
        if($id==""){
            $title = "Add Category";
            $category = new Category;
            $message = "Category added Successfully";
        }else{
            $title = "Edit Category";
            $category = Category::find($id);
            $message = "Category updated Successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            if($id==""){
                $rules = [
                    'category_name'=>'required',
                    'url'=> 'required|unique:categories',
                ];
            }else{
                $rules = [
                    'category_name'=>'required',
                    'url'=> 'required',
                ];
            }

            $customMessages = [
                'category_name.required'=>'Category name is required',
                'url.required'=>'Category url is required',
                'url.unique'=>'Unique Category url is required'
            ];
            $this->validate($request,$rules,$customMessages);
            $imagename='';
            if($request->hasfile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename=rand(111,99999).'.'.$extension;
                    $imagepath='front/images/categories/'.$imagename;
                    Image::make($image_tmp)->save($imagepath);
                    $category->category_image = $imagename ;
                }
                if(empty($data['category_discount'])){
                    $data['category_discount'] = 0;
                }
                $category->category_name = $data['category_name'] ;
                $category->parent_id = $data['parent_id'] ;
                // $category->category_image = $data['category_image'] ;
                $category->category_discount = $data['category_discount'] ;
                $category->description = $data['description'] ;
                $category->url = $data['url'] ;
                $category->meta_description = $data['meta_description'] ;
                $category->meta_keywords = $data['meta_keywords'] ;
                $category->status = 1 ;
                $category->save();
                return redirect('admin/categories')->with('success_message',$message);
        }
    }      
        return view('admin.categories.add_edit_category')->with(compact('title','getCategories','category'));
    }

    public function deleteCategoryImage($id){
        $categoryImage = Category::select('category_image')->where('id',$id)->first();
        $category_image_path = 'front/images/categories/';
        if(file_exists($category_image_path.$categoryImage->category_image)){
            unlink($category_image_path.$categoryImage->category_image);
        }
        Category::where('id',$id)->update(['category_image'=>'']);
        return redirect()->back()->with('success_message','Category image have been updated suceesfully!');
    }
}


