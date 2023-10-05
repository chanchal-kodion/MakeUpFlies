<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticable;
use Validator;
use Hash;
use App\Models\Admin;
use App\Models\AdminsRole;
use Image;
use Session;


class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();

            $rules = [
                'email'=> 'required |email|max:255',
                'password'=>'required|max:30'
            ];
            $custommessages=[
                'email.required'=>"Email is required",
                'email.email'=>"Valid email is required",
                'password.required'=>"password is required",
            ];
            $this->validate($request,$rules,$custommessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])
            ){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with("error_message","Invalid Credentials");
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function update_password(Request $request){
        Session::put('page','updatePassword');
        if($request->isMethod('post')){
            $data= $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            if($data['new_password']==$data['confirm_password']){
                Admin::where('id', Auth::guard('admin')->user()->id)
                ->update(['password' => bcrypt($data['new_password'])]);            
            return redirect()->back()->with("success_message","Your password has been updated successfully!");
            }else{
            return redirect()->back()->with("error_message","Your current password and new password don not match!");
            }
        }else{
            return redirect()->back()->with("error_message","Your current password is incorrect");
        }
        }
        return view('admin.update_password');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request){
        Session::put('page','updateDetails');
        if($request->isMethod('post')){
            $data= $request->all();
            $rules = [
                'admin_name'=> 'required|max:255',
                'mobile'=>'required|numeric|digits:10',
                'admin_image'=>'image'
            ];
            $custommessages=[
                'admin_name.required'=>"Name is required",
                // 'admin_name.alpha'=>"Valid name is required",
                'mobile.required'=>"Mobile is required",
                'mobile.numeric'=>"Valid number is required",
                'mobile.digits'=>"Valid number is required",
                'admin_image.image'=>'Valid image is required',
                // 'mobile.min'=>"Valid number is required",
            ];
            $this->validate($request,$rules,$custommessages);
            $imagename='';
            if($request->hasfile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename=rand(111,99999).'.'.$extension;
                    $imagepath='admin/images/photos/'.$imagename;
                    Image::make($image_tmp)->save($imagepath);
                }else if(!empty($data['current_image'])){
                    $imagename=$data['current_image'];
                }else{
                    $imagename="";
                }
            }
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'],
            'mobile'=>$data['mobile'],'image'=>$imagename]);
            return redirect()->back()->with("success_message","Your account has been updated successfully!");
        }
        return view('admin.update_admin_details');
    }

    public function subadmins(){
        Session::put('page','subadmins');
        $subadmins=Admin::where('type','subadmin')->get();
        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }
    
    public function updateSubadminStatus(Request $request)
    {
        if($request->ajax()){
            $data=$request->all();
            // dd($data);
            // print_r($data);
            if($data['status']=="Active"){
                $status="0";
            }else{
                $status="1";
            }
            Admin::where('id', $data['subadmin_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'subadmin_id'=>$data['subadmin_id']]);
        }
    }

    public function deleteSubadmin($id)
    {
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Subadmin deleted successfully!');
    }

    public function addEditSubadmin(Request $request,$id = null){
        if($id==""){
            $title="Add Subadmin";
            $subadmindata =new Admin;
            $message = "Subadmin added successfully!";
        }else{
             $title="Edit Subadmin";
             $subadmindata =Admin::find($id);
             $message = "Subadmin updated successfully!";
          }
          if($request->isMethod('post')){
            $data = $request->all();

            if($id==""){
                $subadmincount = Admin::where('email',$data['email'])->count();
                
                if($subadmincount>0){
                    return redirect()->back()->with('error_message','Subadmin already exist!');
                }
            }
            $rules=[
                'name'=>'required',
                'mobile'=>'required|numeric',
                'image'=>'image'
            ];
            $customMessages=[
                'name.required'=>'Name is required',
                'mobile.required'=>'Mobile is required',
                'mobile.numeric'=>'Valid mobile is required',
                'image.required'=>'Image is required'
            ];
            $this->validate($request,$rules,$customMessages);
            $imagename='';
            if($request->hasfile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imagename=rand(111,99999).'.'.$extension;
                    $imagepath='admin/images/photos/'.$imagename;
                    Image::make($image_tmp)->save($imagepath);
                }else if(!empty($data['current_image'])){
                    $imagename=$data['current_image'];
                }else{
                    $imagename="";
                }
                $subadmindata->image = $imagename;  
                $subadmindata->name = $data['name'];  
                $subadmindata->mobile = $data['mobile']; 
                if($id==""){
                    $subadmindata->email = $data['email']; 
                    $subadmindata->type = 'subadmin'; 
                } 
                if($data['password']!==""){
                    $subadmindata->password = bcrypt($data['password']);                 
                }
                $subadmindata->save();
            return redirect('admin/subadmins')->with("success_message",$message);   
            }
          }
        return view('admin.subadmins.add_edit_subadmins')->with(compact('title','subadmindata'));
    }

    public function updateRole(Request $request , $id){
        $title = "Update Roles/Permissions";
        if($request->isMethod('post')){
            $data = $request->all();
        AdminsRole::where('admin_id',$id)->delete();
        
        if(isset($data['cms_pages_view'])){
            $cms_pages_view = $data['cms_pages_view'];
        }else{
            $cms_pages_view = 0;
        }
        if(isset($data['cms_pages_edit'])){
            $cms_pages_edit = $data['cms_pages_edit'];
        }else{
            $cms_pages_edit = 0;
        }
        if(isset($data['cms_pages_full'])){
            $cms_pages_full = $data['cms_pages_full'];
        }else{
            $cms_pages_full = 0;
        }
        $role = new AdminsRole;
        $role->admin_id = $id;
        $role->module = 'cms_pages';
        $role->view_access = $cms_pages_view;
        $role->edit_access = $cms_pages_edit;
        $role->full_access = $cms_pages_full;
        $role->save();
        $message = "Subadmin role updated Successfully!";
        return redirect()->back()->with('success_message',$message);
    }
        $subadminroles = AdminsRole::where('admin_id',$id)->get()->toArray();
        return  view('admin.subadmins.update_roles')->with(compact('title','id','subadminroles'));
    }
}

