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
        <div class="div_centre">
            @if(session()->has('message'))
                <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
                </div>
            @endif
        </div>
        <table class="centre table">
            <tr>
                <th>User Name</th>
                <th>Title</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Payment ststus</th>
                <th>Delivery status</th>
                <th>Action</th>
            </tr>
            @forelse($order as $order)
                <tr>
                    <td>{{App\Models\User::where('id', $order->user_id)->value('name')}}</td>
                    <td>{{$order->title}}</td>
                    <td>{{$order->description}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td><img src="product/{{$order->image}}"></td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        @if($order->delivery_status=='Processing')
                        <a href="{{url('cancle_order',$order->id)}}" class="btn btn-danger">Cancle Order</a>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                      <td colspan="9">No Data Found</td>
                    </tr>
                @endforelse
            
        </table>   
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