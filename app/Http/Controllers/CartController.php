<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    
    function ProductDetail(Request $req){
        $idd=$req->id;
        $req->session()->put('idd', $idd);
        $id = $req->id;
        $userId = $req->userId;
        $category=Category::rightJoin( 'products', 'categories.categoryId', '=', 'products.categoryId' )
                    ->where('productId', $id)
                    ->select('categories.categoryName')
                    ->first();
        $product=Product::where('productId', $id)->first();
        $categories=Category::all();
        $products=Product::all();
        //return $admin;

        $productCategory = Category::leftJoin('products', 'categories.categoryId', '=', 'products.categoryId')
                        ->select('products.categoryId','categories.categoryName')
                        ->whereNotNull('products.categoryId')
                        ->distinct()
                        ->get();
        return view('Customer.ProductDetail', ['category' => $category, 'product' => $product ]);
    }

    function ProductDetails(Request $req){
        //return $req;
        $req->validate([
            'color' => 'required',
        ]);

        $product = Product::where('productId', $req->id)->first();
        $cart = Cart::where('userName', session()->get('userNames'))
                ->where('productName', $product->productName)
                ->where('color', $req->color)
                ->first();

        if($cart){
            $cart->price = $cart->price + (($product->sellingPrice) * $req->quantity);
            $cart->quantity = $cart->quantity + $req->quantity;
        }else{
            $cart = new Cart;
            $cart->productName = $product->productName;
            $cart->userName = session()->get('userNames');
            $cart->price = $product->sellingPrice;
            $cart->color = $req->color;
            $cart->quantity = $req->quantity;
            $cart->picture = $product->picture;
            session()->put('cart', Cart::where('userName', session()->get('userNames'))->count());
        }
        
        if(session()->has('LoggedUser')){
            $cart->save();
            session()->put('cart', Cart::where('userName', session()->get('userNames'))->count());
            return redirect()->route('CheckOut');
        }else{
            return redirect()->route('login', ['idd' => 1, 'ids' =>  $req->id ]);
        }
    }

    function Cart(Request $req){
        $totalCart = Cart::where('userName', session()->get('userNames'))->count();
        if($totalCart){
            session()->put('cart',  $totalCart);
        }else{
            session()->put('cart',  $req->total);
        }
        if(session()->has('LoggedUser')){

            $id= (string)session()->get('userNames');
            $sql="select id, productName, color, picture, quantity, price from carts where userName={$id}";
            $cart = DB::select(DB::raw($sql));
            $subtotal = 0;

            foreach($cart as $item){
                $subtotal = $subtotal + ($item->price * $item->quantity);
            }
            return view('Customer.Cart',['cart' => $cart, 'subtotal' => $subtotal]);
        }else{
            return redirect()->route('login', ['idd' => 1, 'ids' =>  $req->id ]);
        }
        
        //if(session()->has('LoggedUser')){
           // return view('Customer.Cart',['cart' => $cart, 'subtotal' => $subtotal]);
        //}
        //return redirect()->route('login', ['idd' => 1, 'ids' =>  $req->id ]);
        //return view('Customer.Cart',['cart' => $cart, 'subtotal' => $subtotal]);
    }

    function UpdateCart(){
        $id= (string)session()->get('userNames');
        //return $id;
        $sql="select productName, picture,  sum(quantity) as quantity, sum(price) as totalPrice, price from carts where userName={$id} group by productName, picture, price";
        $cart = DB::select(DB::raw($sql));
        $subtotal = 0;
        foreach($cart as $item){
            $subtotal = $subtotal + $item->totalPrice;
        }
        return view('Customer.Cart',['cart' => $cart, 'subtotal' => $subtotal]);
    }

    function CheckOut(){
        $id= (string)session()->get('userNames');
        $sql="select  productName, color, picture, quantity, price from carts where userName={$id}";
        $cart = DB::select(DB::raw($sql));
        $subtotal = 0;
        $tax=0;
        foreach($cart as $item){
            $subtotal = $subtotal + ($item->price * $item->quantity);
        }
        $tax = ceil((3/100)*$subtotal);
        $total = $subtotal + $tax;
        return view('Customer.CheckOut', ['cart'=> $cart, 'subtotal' => $subtotal, 'tax' => $tax, 'total' => $total]);
    }

    function PlaceOrder(Request $req){

        $req->validate([
            'name' => 'required|string',
            'phone'=>[
                'required',
                'regex:/[0-9]/',
                'string',
                'min:11',
                'max:11'             
            ],
            'address' => 'required|string',
            'address' => 'required',
            'paymentMethod' => 'required'
        ]);

        $order = new Order;

        $order->userName = $req->userName;
        $order->name = $req->name;
        $order->district = $req->district;
        $order->phone = $req->phone;
        $order->address = $req->address;
        $order->note = $req->note;
        $order->paymentMethod = $req->paymentMethod;
        $done = $order->save();

        if($done){
            return back()->with('success', 'Your Order Received Successfully');
        }else{
            return back()->with('error', 'Error');
        }

    }
    
}
