<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Famms Admin</title>
    @include('admin.style')
    <style type="text/css">
        .div_centre {
            text-align: center;
        }
        .centre {
          margin: auto;
          text-align: center;
          width: 100%;
          margin-top: 20px;
          border: 3px solid white;
          color: white;
        }
        .centre img {
            width: 100px !important;
            height: 60px !important;
        }
        .centre th {
            padding: 5px;
            width: 10px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="div_centre">
                  @if(session()->has('message'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      {{session()->get('message')}}
                    </div>
                  @endif
                    <h2>Product</h2>
                </div>
                <div class="">
                  <form action="{{url('search')}}" method="get">
                    @csrf
                    <input type="text" name="search" placeholder="Search here">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                  </form>
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
                        @if($order->delivery_status!='Delivered')
                            <a href="{{url('order-deliver',$order->id)}}" class="btn btn-primary">Delivered</a>

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
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
  </body>
</html>