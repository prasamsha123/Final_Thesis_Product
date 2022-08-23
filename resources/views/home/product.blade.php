<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row" style="margin-bottom: 20px;">
               @foreach($product as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_detail',$product->id)}}" class="option1">
                           Product Detail
                           </a>
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
                     <div class="img-box">
                        <img src="product/{{$product->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product->title}}
                        </h5>
                        @if($product->discount_price)
                           <h6>
                              Discount Price <br>
                              ${{$product->discount_price}}
                           </h6>
                           <h6 style="text-decoration: line-through;">
                              Price <br>
                              ${{$product->price}}
                           </h6>
                        @else
                           <h6>
                              Price <br>
                              ${{$product->price}}
                           </h6>
                        @endif
                        
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
            <span style="margin-top: 40px;"></span>
            <!-- {{$product = App\Models\Product::paginate(3);}} -->
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
         </div>
      </section>