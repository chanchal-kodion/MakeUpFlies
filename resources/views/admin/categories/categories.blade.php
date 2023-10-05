@extends('admin.layout.layout')
  @section('content')
  <!-- Content Wrapper. Contains category content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(Session::has('error_message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:  </strong> {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category Pages</h3>
                <a style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-primary" 
                href="{{url('admin/add-edit-category')}}">Add Categories</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>URL</th>
                    <th>Created On</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($categories as $category)
                  <tr>
                    <td>{{$category['id']}}</td>
                    <td>{{$category['category_name']}}</td>
                    <td>
                        @if(isset($category['parentcategory']['category_name']))
                        {{$category['parentcategory']['category_name']}}
                        @endif
                      </td>
                    <td>{{$category['url']}}</td>
                    <td>{{ date("d-m-Y", strtotime($category['created_at'])) }}</td>
                    <td>         
                    @if($categoriesModule['full_access']==1 || $categoriesModule['edit_access']==1 ) 
                            @if($category['status']==1)    
                                <a href="javascript:void(0)" id="category-{{$category['id']}}" class="updateCategoryStatus"  
                                category_id="{{$category['id']}}"><i class="fas fa-toggle-on" status="Active"></i></a>
                            @else
                                <a style="color:grey;" href="javascript:void(0)" id="category-{{$category['id']}}" class="updateCategoryStatus"
                                category_id="{{$category['id']}}"><i status="Inactive" class="fas fa-toggle-off"></i></a>
                            @endif
                    @endif
                    @if($categoriesModule['full_access']==1 || $categoriesModule['edit_access']==1 )    
                            &nbsp;&nbsp;    
                            <a href="{{url('admin/add-edit-category/'.$category['id'])}}"><i class="fas fa-edit"></i></a>
                            &nbsp;&nbsp;
                    @endif        
                    @if($categoriesModule['full_access']==1 )    
                            <a href="{{url('admin/delete-category/'.$category['id'])}}"><i class="fas fa-trash"></i></a>
                    @endif
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
                 </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection