@extends('admin.layout.layout')
  @section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
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
              @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:  </strong> {{Session::get('success_message')}}
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
              <form name="productForm" id="productForm" @if(empty($product['id'] ))
               action="{{url('admin/add-edit-product')}}"
                @else action="{{url('admin/add-edit-product/'.$product['id'])}}" @endif method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                <div class="form-group">
                    <label for="category_id">Select Category*</label>
                    <select class="form-control" name="category_id">
                      <option value="">Select</option>
                      @foreach($getCategories as $cat)
                        <option @if(!empty(@old('category_id')) && $cat['id'] == @old('category_id')) selected = ""
                        @elseif(!empty($product['category_id']) &&$product['category_id'] == $cat['id']) selected="" @endif
                        value="{{$cat['id']}}">{{$cat['category_name']}}</option>
                        @if(!empty($cat['subcategories']))
                        @foreach($cat['subcategories'] as $subcat)
                        <option @if(!empty(@old('category_id')) && $subcat['id'] == @old('category_id')) selected = ""
                        @elseif(!empty($product['category_id']) &&$product['category_id'] == $subcat['id']) selected="" @endif
                        value="{{$subcat['id']}}">&nbsp;&nbsp;&raquo;{{$subcat['category_name']}}</option>
                        @if(!empty($subcat['subcategories']))
                        @foreach($subcat['subcategories'] as $subsubcat)
                        <option @if(!empty(@old('category_id')) && $subsubcat['id'] == @old('category_id')) selected = ""
                        @elseif(!empty($product['category_id']) &&$product['category_id'] == $subsubcat['id']) selected="" @endif
                        value="{{$subsubcat['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;{{$subsubcat['category_name']}}</option>
                      @endforeach
                      @endif
                      @endforeach
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="product_name">Product Name*</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" 
                    @if(!empty($product['product_name'])) value="{{$product['product_name']}}"
                    @else value="{{ old('product_name') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="product_code">Product Code*</label>
                    <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code"
                    @if(!empty($product['product_code'])) value="{{$product['product_code']}}"
                    @else value="{{ old('product_code') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="product_color">Product Color*</label>
                    <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter product color"
                    @if(!empty($product['product_color'])) value="{{$product['product_color']}}"
                    @else value="{{ old('product_color') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="group_code">Group Code</label>
                    <input type="text" class="form-control" id="group_code" name="group_code" placeholder="Enter product code"
                    @if(!empty($product['group_code'])) value="{{$product['group_code']}}"
                    @else value="{{ old('group_code') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="product_price">Product Price*</label>
                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price"
                    @if(!empty($product['product_price'])) value="{{$product['product_price']}}"
                    @else value="{{ old('product_price') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="product_discount">Product Discount(%)</label>
                    <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter product discount"
                    @if(!empty($product['product_discount'])) value="{{$product['product_discount']}}"
                    @else value="{{ old('product_discount') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="product_weight">Product Weight</label>
                    <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter product weight"
                    @if(!empty($product['product_weight'])) value="{{$product['product_weight']}}"
                    @else value="{{ old('product_weight') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="product_video">Product Image</label>
                    <input type="file" class="form-control" id="product_video" name="product_video" >
                    @if(!empty($product['product_video']))
                    <a target = "_blank" href = "{{url('front/images/products/'.$product['product_video'])}}">View Image</a>
                    &nbsp;&nbsp;   
                    <a href="{{url('admin/delete-product-image/'.$product['id'])}}"><i class="fas fa-trash"></i>Delete</a>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter product Description">
                  </div> 
                  <div class="form-group">
                    <label for="product_quantity">Product Quantity</label>
                    <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Enter product weight"
                    @if(!empty($product['product_quantity'])) value="{{$product['product_quantity']}}"
                    @else value="{{ old('product_quantity') }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="washcare">Washcare</label>
                    <input type="text" class="form-control" id="washcare" name="washcare" placeholder="Enter product washcare">
                  </div> 
                  <div class="form-group">
                    <label for="search_keywords">Search Keywords</label>
                    <input type="text" class="form-control" id="search_keywords" name="search_keywords" placeholder="Enter product Search Keywords">
                  </div> 
                  <div class="form-group">
                    <label for="is_featured">Featured Items</label>
                    <input type="checkbox" name="is_featured" value = "Yes">
                  </div> 
                  <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title"
                    >
                  </div> 
                  <div class="form-group">
                    <label for="meta_keywords">Meta URL</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta keywords"
                   >
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description"
                    >
                  </div> 
                </div>
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