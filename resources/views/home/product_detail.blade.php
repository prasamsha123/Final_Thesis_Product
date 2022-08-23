<!DOCTYPE html>
<html>
   <head>
      @include('home.style')
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         
         <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%;padding:20px;margin-top:20px;margin-bottom:20px;">
            <div class="img-box">
               <img src="product/{{$product->image}}" alt="" style="width: 50%;">
            </div>
            <div class="detail-box">
               <h5>
                  {{$product->title}}
               </h5>
            </div>
            <h6>
               Product Detail : {{$product->description}}
            </h6>
            <h6>
               Product Category : {{App\Models\Categories::where('id', $product->category)->value('category')}}
            </h6>
            @if($product->discount_price)
               <h6>
                  Discount Price : ${{$product->discount_price}}
               </h6>
               <h6 style="text-decoration: line-through;">
                  Price : ${{$product->price}}
               </h6>
            @else
               <h6>
                  Price : ${{$product->price}}
               </h6>
            @endif
            <h6>
               Product Quantity : {{$product->quantity}}
            </h6>
            <form method="POST" action="{{url('add-cart', $product->id)}}">
               @csrf
               <div class="row" style="padding: 10px;">
                  <div class="col-md-4">
                     <input type="number" name="quantity" value="1" min="1">
                  </div>
                  <div class="col-md-4">
                     <input type="submit" name="submit" value="Add to cart">
                  </div>
               </div>
            </form>
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