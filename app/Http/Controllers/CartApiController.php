<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartApiController extends Controller
{

    function getCart(){
        return Cart::all();
    }
    
    function AddToCart(Request $req){
        
        $req->validate([
            'color' => 'required',
        ]);

        $product = Product::where('productId', $req->id)->first();
        $cart = Cart::where('userName', $req->userName)
                ->where('productName', $product->productName)
                ->where('color', $req->color)
                ->first();
        if($cart){
            $cart->price = $cart->price + (($product->sellingPrice) * $req->quantity);
            $cart->quantity = $cart->quantity + $req->quantity;
            $cart->save();
            $totalCart = Cart::where('userName', $req->userName)->count();
            return $totalCart;
        }else{
            $cart = new Cart;
            $cart->productName = $product->productName;
            $cart->userName = $req->userName;
            $cart->price = $product->sellingPrice;
            $cart->color = $req->color;
            $cart->quantity = $req->quantity;
            $cart->picture = $product->picture;
            $cart->save();
            $totalCart = Cart::where('userName', $req->userName)->count();
            return $totalCart;
        }

    }

    function Update(Request $req, $userName, $cartId, $updatedQuantity){
        $cart = Cart::where('userName', $userName)
                        ->where('id', $cartId)
                        ->update(['quantity' => $updatedQuantity]);

        $cart = Cart::where('userName', $userName)
                ->where('id', $cartId)
                ->get();

        return $cart;
    }

}
