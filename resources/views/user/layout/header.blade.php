<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Web Make-UpFLies</title>
    <style>
        .footer-main{
        padding-top: 90px;b
    }
          .badge {
        padding-left: 9px;
        padding-right: 9px;
        -webkit-border-radius: 9px;
        -moz-border-radius: 9px;
        border-radius: 9px;
      }

      .label-warning[href],
      .badge-warning[href] {
        background-color: #c67605;
      }
      #lblCartCount {
          font-size: 12px;
          background: #ff0000;
          color: #fff;
          padding: 0 5px;
          vertical-align: top;
          margin-left: -10px; 
      }
      .sticky-header {
          background-color: #fff;
          padding: 10px 0;
          position: sticky;
          top: 0;
          z-index: 100; 

      }

    </style>
  </head>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-header">
      <a class="navbar-brand" href="#">MakeUp Flies</a>    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Explore Men's Section
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Topwears</a>
              <a class="dropdown-item" href="#">Bottom Wears</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Shoes</a>
            </div>
          </li>
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                  Explore Women's Section
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Topwears</a>
                  <a class="dropdown-item" href="#">Bottom Wears</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Shoes</a>
                </div>
          </li>
        </ul>
      </div>
              @php
                  $a=10;
              @endphp
              @if ($a==10)
              <div class="justify-content-end">
                <!-- <a href="{{url('web-login')}}"> <button class="btn btn-primary" type="submit">Login</button></a>    -->
                <a href="{{url('user/cart')}}"><button class="btn btn-warning text-white" type="button"><i class="fa-solid fa-cart-shopping"></i></button></a>  
              </div> 
              @else
                
                <div class="dropdown" style="">
                  <button class="btn btn-info dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mario
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Logout</a>
                    <a class="dropdown-item" href="#"></a>
                  </div>
                </div>

                <div class="profile-pic" style="padding-left: 3px;">
                  <img src="https://plus.unsplash.com/premium_photo-1695635984457-a6010a4bec28?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyfHx8ZW58MHx8fHx8&auto=format&fit=crop&w=400&q=60" alt="" style="height:40px; width:40px; border-radius:20px;">
                </div>
                
             
                <div class="justify-content-end"  style="padding-left: 20px;">
                  <a href="{{url('cart-2')}}"> <button class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i></button></a>
                  <span class='badge badge-warning' id='lblCartCount'> 5 </span>
                </div>              
              @endif
    </nav>
