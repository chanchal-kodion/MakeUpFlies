@extends('admin.layout.layout')
  @section('content')
  <!-- Content Wrapper. Contains product content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title">Product Pages</h3>
                <a style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-primary" 
                href="{{url('admin/add-edit-product')}}">Add products</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>
                    <th>Category</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>{{$product['id']}}</td>
                    <td>{{$product['product_name']}}</td>
                    <td>{{$product['product_code']}}</td>
                    <td>{{$product['product_color']}}</td>       
                    <td>{{$product['category']['category_name']}}</td>       
                    <td>
                      @if(isset($product['category']['parentcategory']['category_name']))
                      {{$product['category']['parentcategory']['category_name']}}
                      @endif
                    </td>       
                    <td>
                            @if($product['status']==1)    
                                <a href="javascript:void(0)" id="product-{{$product['id']}}" class="updateProductStatus"  
                                product_id="{{$product['id']}}"><i class="fas fa-toggle-on" status="Active"></i></a>
                            @else
                                <a style="color:grey;" href="javascript:void(0)" id="product-{{$product['id']}}" class="updateProductStatus"
                                product_id="{{$product['id']}}"><i status="Inactive" class="fas fa-toggle-off"></i></a>
                            @endif  
                            &nbsp;&nbsp;    
                            <a href="{{url('admin/add-edit-product/'.$product['id'])}}"><i class="fas fa-edit"></i></a>
                            &nbsp;&nbsp;   
                            <a href="{{url('admin/delete-product/'.$product['id'])}}"><i class="fas fa-trash"></i></a>
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