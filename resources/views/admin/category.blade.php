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
          width: 50%;
          margin-top: 20px;
          border: 3px solid white;
          color: white;
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
                    <h2>Add Category</h2>

                    <form method="POST" action="add-category" class="form-inline">
                      @csrf
                      <div class="form-group mx-sm-3 mb-2 mt-5">
                        <input type="text" class="form-control" placeholder="Category" name="category" style="color:white;">
                      </div>
                      <button type="submit" class="btn btn-primary mb-2 mt-5">Add</button>
                    </form>
                </div>

                <table class="centre table">
                  <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>

                  @foreach($data as $data)
                    <tr>
                      <td>{{$data->category}}</td>
                      <td>
                        <a href="{{url('delete-category',$data->id)}}" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to delete the category')">Delete</a>
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