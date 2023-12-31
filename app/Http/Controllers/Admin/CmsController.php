<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use Session;
use Auth;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','cms-pages');
        $CmsPages = CmsPage::get()->toArray();
        
        $cmspagemodulecount = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->count();
        $pagesModule = array();
        if(Auth::guard('admin')->user()->type=="admin"){
            $pagesModule['view_access'] = 1 ;
            $pagesModule['edit_access'] = 1 ;
            $pagesModule['full_access'] = 1 ;
        }else if($cmspagemodulecount == 0){
            $message = "This feature is disabled for you!";
            return redirect('admin/dashboard')->with('error_message',$message); 
        }else{
            $pagesModule =  AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->first()->toArray();
        }
        return view('admin.pages.cms_pages')->with(compact('CmsPages','pagesModule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id = null)
    {
        Session::put('page','cms-pages');
        if($id==""){
          $title="Add cms page";
          $cmspage =new CmsPage;
          $message = "CMS page added successfully!";
        }else{
           $title="Edit cms page";
           $cmspage =CmsPage::find($id);
           $message = "CMS page updated successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // print_r($data);
            $rules=[
                'title'=>'required',
                'url'=>'required',
                'description'=>'required'
            ];
            $customMessages=[
                'title.required'=>'Page title is required',
                'url.required'=>'Page url is required',
                'description.required'=>'Page decription is required'
            ];
            $this->validate($request,$rules,$customMessages);

            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->status = 1;
            $cmspage->save();
            return redirect('admin/cms-pages')->with('success_message',$message);
        }
        return view('admin.pages.add_edit_cms_page')->with(compact('title','cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id',$id)->delete();
        return redirect()->back()->with('success_message','CMS page deleted successfully!');
    }

}