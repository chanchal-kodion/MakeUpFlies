@extends("user.layout.main-layout")
@section("content")
<div class="row" style="padding-left: 70px;">
    @foreach($products as $product)
    <div class="col-4 mt-5">
        <div class="card" style="width: 18rem;">
            <img style="    width: 100%;height: 15vw; object-fit: cover;" src="{{ asset('front/images/products/' . $product['product_video']) }}">
            <div class="card-body">
              <h5 class="card-title">{{$product['product_name']}}</h5>
              <p class="card-text">{{$product['description']}}</p>
              <p class="card-text" style="float:left;">{{$product['product_price']}}</p>
              <p class="card-text text-end">{{$product['final_price']}}</p>
              <div class="d-flex justify-content-around">
                <a href="javascript:void(0)" onclick = "addtocart({{$product['id']}})" class="btn btn-warning text-white">Add To Cart</a>
                <a href="#" class="btn btn-info text-white">Buy Now</a>
              </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
