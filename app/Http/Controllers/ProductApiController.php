<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{

    function GetProduct(){

        $Product = Product::all();

        return $Product;

    }

    function GetProductById($id){

        $Product = Product::find($id);

        return $Product;

    }
    
    // function UpdateProduct(Request $request, $id){

    //     $Product = Product::find($id);
    //     $Product->update($request->all());

    //     return $Product;

    // }

    function DeleteProduct($id){

        $query = Product::where('productId', $id)->delete();

        if($query){
            return response('No Content', 204);
        }
        return response('Bad Request', 400);

    }

    function BlockProduct($id){

        $product = Product::where('productId','=', $id)->first();

        $product->quantity = $product->quantity*-1;

        $query = $product->update();

        if($query){
            return response($product, 200);
        }

        return response('Bad Request', 400);

    }  

    function SearchProduct(Request $req){
        $query = $req->get('query');
        if($query!=""){
            return Product::where('productName', 'like', '%'.$query.'%')->get();
        }else{
            $product = Product::take(5)->get();
            return $product;
        }

    }

}
