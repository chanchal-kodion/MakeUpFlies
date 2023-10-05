@extends('admin.layout.layout')
  @section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subadmins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
        </div>
        <!-- /.card -->
 
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                @if(Session::has('error_message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error:  </strong> {{Session::get('error_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:  </strong> {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @endif
              <form name="subadminForm" id="subadminForm" action="{{url('admin/update-role/'.$id)}}" 
              method="post">
              
                @csrf             
                @if(!empty($subadminroles))
                @foreach($subadminroles as $role)
                    @if($role['module']=="cms_pages")
                        @php
                            $viewCMSPages = ($role['view_access'] == 1) ? 'checked' : '';
                            $editCMSPages = ($role['edit_access'] == 1) ? 'checked' : '';
                            $fullCMSPages = ($role['full_access'] == 1) ? 'checked' : '';
                        @endphp
                    @endif
                    @if($role['module']=="categories")
                        @php
                            $viewCategories = ($role['view_access'] == 1) ? 'checked' : '';
                            $editCategories = ($role['edit_access'] == 1) ? 'checked' : '';
                            $fullCategories = ($role['full_access'] == 1) ? 'checked' : '';
                            dd($viewCategories);
                        @endphp
                    @endif
                @endforeach
                @endif
                <div class="card-body">
                    <label for="email">CMS Pages:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                    <input type="checkbox" name="cms_pages_view" value = "1" @if(isset($viewCMSPages)) {{ $viewCMSPages }} @endif>View Access &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="cms_pages_edit" value = "1" @if(isset($editCMSPages)) {{ $editCMSPages }} @endif>View/Edit Access &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="cms_pages_full" value = "1" @if(isset($fullCMSPages)) {{ $fullCMSPages }} @endif>Full Access &nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                <!-- <div class="card-body">
                    <label for="categories">Categories:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                    <input type="checkbox" name="categories_view" value = "1" @if(isset($viewCategories)) {{ $viewCategories }} @endif>View Access &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="categories_edit" value = "1" @if(isset($editCategories)) {{ $editCategories }} @endif>View/Edit Access &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="categories_full" value = "1" @if(isset($fullCategories)) {{ $fullCategories }} @endif>Full Access &nbsp;&nbsp;&nbsp;&nbsp;
                  </div> -->
                <!-- /.card-body -->
                <div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer"></div>
        </div>
        <!-- /.card -->


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection