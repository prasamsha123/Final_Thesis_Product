<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;
use Stripe;

class AdminController extends Controller
{
    public function view()
    {
        $product = Product::paginate(10);
        return view('home.user', compact('product'));
    } 

    public function view_home()
    {
        $product = Product::paginate(10);
        $usertype = Auth::user()->usertype;
        $productCount = Product::all()->count();
        $totalOrder = Order::all()->count();
        $totalUser = User::all()->count();
        $order = Order::all();
        $totalRevenue = 0;

        foreach($order as $order) {
            $totalRevenue = $totalRevenue + $order->price;
        }

        $totaldelivery = Order::where('delivery_status', '=', 'Delivered')->get()->count();
        $totalprocessing = Order::where('delivery_status', '=', 'Processing')->get()->count();
        if($usertype == 1){
            return view('admin.home', compact('productCount', 'totalOrder', 'totalUser', 'totalRevenue', 'totaldelivery', 'totalprocessing'));
        }
        else {
            return view('home.user', compact('product'));
        } 
    }   

    public function view_category()
    {
        $data = Categories::all(); 
        return view('admin.category', compact('data'));
    }

    public function addActivity(Request $request)
    {
        Categories::create(
            [
                'category' => $request->category,
            ]
        );
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = Categories::find($id);
        $data->delete(); 
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function view_product()
    {
        $data = Categories::all();
        return view('admin.product', compact('data'));
    }

    public function add_product(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;

        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $data = Product::all();
        return view('admin.show_product', compact('data'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);
        $data->delete(); 
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function edit_product($id)
    {
        $data = Product::find($id);
        $category = Categories::all();
        return view('admin.update_product', compact('data', 'category'));
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;

        $image = $request->image;
        if($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

    public function product_detail($id)
    {
        $product = Product::find($id);        
        $category = Categories::all();
        return view('home.product_detail', compact('product', 'category'));
    }

    public function add_cart(Request $request, $id)
    {
        $product = Product::find($id);
        $user = Auth::user();
        
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->title = $product->title;
        $cart->description = $product->description;
        if($product->discount_price) {
            $cart->price = $product->discount_price*$request->quantity;
        } else {
            $cart->price = $product->price*$request->quantity;
        }
        $cart->image = $product->image;
        $cart->quantity = $request->quantity;

        $cart->save();

        return redirect()->back();
    }

    public function show_cart()
    {
        $user = Auth::user();
        $cart = Cart::all();
        return view('home.show-cart', compact('user', 'cart'));
    }

    public function delete_cart_product($id)
    {
        $data = Cart::find($id);
        $data->delete(); 
        return redirect()->back()->with('message', 'Cart product Deleted Successfully');
    }

    public function cash_on_delivery()
    { 
        $user = Auth::user();
        $user_id = $user->id;

        $data = Cart::where('user_id','=', $user_id)->get();

        foreach($data as $data) {
            $order = new Order();
            $order->user_id = $data->user_id;
            $order->product_id = $data->product_id;
            $order->title = $data->title;
            $order->description = $data->description;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->quantity = $data->quantity;
            $order->payment_status = "Cash on delivery";
            $order->delivery_status = "Processing";

            $order->save();

            $delete = Cart::find($data->id);
            $delete->delete(); 
        }
        return redirect()->back()->with('message', 'Order has been placed');
    }

    public function stripe($totalprice)
    { 
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thank you for payment" 
        ]);
      
        Session::flash('success', 'Payment successful!');

        $user = Auth::user();
        $user_id = $user->id;

        $data = Cart::where('user_id','=', $user_id)->get();

        foreach($data as $data) {
            $order = new Order();
            $order->user_id = $data->user_id;
            $order->product_id = $data->product_id;
            $order->title = $data->title;
            $order->description = $data->description;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->quantity = $data->quantity;
            $order->payment_status = "Card Payment";
            $order->delivery_status = "Processing";

            $order->save();

            $delete = Cart::find($data->id);
            $delete->delete(); 
        }
              
        return back();
    }

    public function order_product()
    { 
        $order = Order::all();
        return view('admin.order', compact('order'));
    }

    public function order_deliver($id)
    { 
        $order = Order::find($id);
        $order->delivery_status = 'Delivered';
        $order->delivery_status = 'Paid';

        $order->save();

        return redirect()->back()->with('message', 'Product Delivered');
    }

    public function search(Request $request)
    { 
        $search = $request->search;
        $order = Order::where('title', 'LIKE', "%$search%")->get();

        return view('admin.order', compact('order'));
    }

    public function show_order() {
        $user = Auth::user();
        $order = Order::where('user_id', '=', $user->id)->where('delivery_status', '!=', 'Delivered')->get();
        return view('home.order', compact('order'));
    }

    public function cancle_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'Order Cancled';
        $order->save();
        return redirect()->back()->with('message', 'Order Deleted Successfully');
    }
}