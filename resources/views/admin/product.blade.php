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
        label {
            margin-right: 50px;
            display: inline-block;
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
                    <h2>Add Product</h2>

                    <form method="POST" action="{{url('add-product')}}" enctype="multipart/form-data">
                      @csrf
                      <div>
                        <label>Product Title:</label>
                        <input type="text" class="form" placeholder="Title" name="title" required="">
                      </div><br>
                      <div>
                        <label>Description:</label>
                        <input type="text" class="form" placeholder="Description" name="description" required="">
                      </div><br>
                      <div>
                        <label>Image:</label>
                        <input type="file" name="image" required="">
                      </div><br>
                      <div>
                        <label>Category:</label>
                        <select required="" name="category">
                            <option value="" selected="">Select category</option>
                            @foreach($data as $data)
                                <option value="{{$data->id}}">{{$data->category}}</option>
                            @endforeach
                        </select>
                      </div><br>
                      <div>
                        <label>Quantity:</label>
                        <input type="number" class="form" placeholder="Quantity" min="0" name="quantity" required="">
                      </div><br>
                      <div>
                        <label>Price:</label>
                        <input type="number" class="form" placeholder="Price" name="price" required="">
                      </div><br>
                      <div>
                        <label>Discount Price:</label>
                        <input type="number" class="form" placeholder="Discount Price" name="discount_price">
                      </div><br>
                      <div>
                        <input type="submit" value="Add Product" class="btn btn-primary">
                      </div>
                    </form>
                </div>                

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