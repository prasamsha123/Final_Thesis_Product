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
          width: 90%;
          margin-top: 20px;
          border: 3px solid white;
          color: white;
        }
        .centre img {
            width: 140px !important;
            height: 100px !important;
        }
        .centre th {
            padding: 20px;
            width: 40px;
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

                <table class="centre table">
                  <tr>
                    <th>Title</th>
                    <th>description</th>
                    <th>category</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>discount_price</th>
                    <th>image</th>
                    <th>Action</th>
                  </tr>

                  @foreach($data as $data)
                    <tr>
                      <td>{{$data->title}}</td>
                      <td>{{$data->description}}</td>
                      <td>{{App\Models\Categories::where('id', $data->category)->value('category')}}</td>
                      <td>{{$data->quantity}}</td>
                      <td>{{$data->price}}</td>
                      <td>{{$data->discount_price}}</td>
                      <td><img src="product/{{$data->image}}"></td>
                      <td>
                        <a href="{{url('delete-product',$data->id)}}" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete the product')">Delete</a> / 
                        <a href="{{url('edit-product',$data->id)}}" class="btn btn-success"">Edit</a>
                      </td>
                    </tr>
                  @endforeach
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