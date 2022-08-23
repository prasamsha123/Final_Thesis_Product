<!DOCTYPE html>
<html>
   <head>
      @include('home.style')
      <style type="text/css">
        .centre {
          margin: auto;
          text-align: center;
          width: 90%;
          margin-top: 20px;
          border: 3px solid black;
          color: black;
        }
        .centre img {
            width: 140px !important;
            height: 100px !important;
        }
        .centre th {
            padding: 20px;
            width: 40px;
        }
        .total_price {
            margin-top: 20px;
            text-align: center;
            margin-bottom: 10px;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
        <div>
            <div class="div_centre">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                    </div>
                @endif
            </div>
            <?php $totalprice=0;?>
            <table class="centre table">
                <tr>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                @foreach($cart as $cart)
                    <tr>
                        @if($user->id == $cart->user_id)                            
                            <td>{{$cart->title}}</td>
                            <td>{{$cart->quantity}}</td>
                            <td>${{$cart->price}}</td>
                            <td><img src="product/{{$cart->image}}"></td>
                            <td>
                                <a href="{{url('delete-cart-product',$cart->id)}}" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete the product from the cart')">Delete</a>
                            </td>
                            <?php 
                                $totalprice = $totalprice +  $cart->price;
                            ?>
                        @endif
                    </tr>
                @endforeach
            </table>
            <p class="total_price"><b>Total price = ${{$totalprice}}</b></p>
            <div class="total_price">
                <p class="mb-2">Proceed to order:</p>
                <a href="{{url('cash-on-delivery')}}" class="btn btn-danger">Cash on delivery</a> or 
                <a href="{{url('stripe', $totalprice)}}" class="btn btn-danger">Online payment</a>
            </div>
        </div>
      </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="/">P.A</a><br>
         
            Distributed By <a href="/">Prasamsha Adhikari</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>