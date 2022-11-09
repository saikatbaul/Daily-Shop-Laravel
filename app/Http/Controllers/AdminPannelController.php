<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Image;
use Illuminate\Support\Facades\Hash;

class AdminPannelController extends Controller
{
    function home(){
        //return session()->get('LoggedUser');
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.Home', ['user' => $user]);
    }

    function profile(){
        //return session()->get('LoggedUser');
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.ProfileSettings', ['user' => $user]);
    }

    function ChangePassword(){
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.ChangePassword', ['user' => $user]);
    }

    function ChangedPassword(Request $req){
        //return $req;
        $req->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:4',
            'newCPassword' => 'required|min:4',
        ]);

        $user = User::find(session()->get('LoggedUser'));

        if(Hash::check($req->newPassword, $user->password)){
            $user->password=Hash::make($req->newPassword);
            $user->save();
        }else{
            return back()->with('fail', 'Your old password is not correct');
        }
        if($user->save()){
            return back()->with('success', 'Password saved');
        }else{
            return back()->with('fail', 'Invalid request');
        }
    }

    function UploadPhoto(){
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        $image = $user->picture;
        return view('Admin.UploadPhoto', ['image' => $image, 'user'=>$user]);
    }

    function UploadedPhoto(Request $req){
        $req->validate([
            'picture' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);

        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        
        $temp=true;

        if($req->file('picture')){
            $image = $req->file('picture');
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);  
            $image_resize->save(public_path('images/'.$filename));
            $image = base64_encode($image_resize);
        }else{
            $image = $user->picture;
            $temp=false;
        }

        $user->picture=$image;
        $query=$user->save();

        if($query){
            $req->session()->put('picture', $user->picture);
            if($temp){
                return back()->with('success', 'Upload successful');
            }else{
                return back()->with('fail', 'This photo is allready in the system');
            }
        }else{
            return "back()";
        }
    }

    function ViewProfile(){
        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
        return view('Admin.ViewProfile', ['user'=> $user]);
    }

    function UpdateProfile(Request $request){

        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>[
                'required',
                'regex:/[0-9]/',
                'string',
                'min:11',
                'max:11'             
            ],
            'address'=>'required|string',
            'district'=>'required|string'
        ]);

        $user = Admin::where('userName', '=', session()->get('LoggedUser'))
                ->orWhere('email', '=', session()->get('LoggedUser'))
                ->first();
                
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->district=$request->district;

        $query=$user->save();


        if($query){
            return back()->with("success", "Update Successful");
        }else{
            return back()->with("fail", "Update Failed");
        }
    }

    function AddCategory(){
        return view("Admin.AddCategory");
    }

    function AddedCategory(Request $req){

        $req->validate([
            'categoryName' => 'required|string|unique:categories'
        ]);

        $category = new Category;
        
        $category->categoryName = $req->categoryName;
        $query = $category->save();

        if($query){
            return back()->with('success', 'Category add successful');
        }else{
            return back()->with('fail', 'Submission failed');
        }
    }

    function CustomizeCategory(Request $req){

        //return session('startPoint');
        $id = $req->id;

        $totalRow = Category::count();
        $total=$totalRow;
        $totalRow = floor($totalRow/5);

        if($total>25){
            if($id==0 || $id==1){
                $startPoint=2;
            }
            if($id!=1 && $id!=$totalRow && $id>=2 && $id<=$totalRow-3){
                if($id==2){
                    $startPoint=$id;
                }else{
                    $startPoint=$id-1;
                }
            }else{
                if($id<=$totalRow && $id>$totalRow-3){
                    $startPoint=$totalRow-3;
                }
            }
        }else{
            $startPoint=1;
        }

        if($total>0){
            $firstId=Category::first()->categoryId;
            $lastId=Category::latest()->first()->categoryId;

            $category = Category::skip(($id-1)*5)->take(5)->get();

            return view('Admin.CustomizeCategory', ['category' => $category, 'startPoint' => $startPoint, 'totalRow' => $totalRow, 'clickedId' =>$id, 'total' => $total ]);
        }

        return back();

    }
    
    function AddProduct(){

        $category = Category::all();

        return view('Admin.AddProduct', ['category' => $category]); 
    } 

    function AddedProduct(Request $req){

        $req->validate([
            'productName' => 'required|string',
            'description' => 'required|string',
            'buyingPrice' => 'required|integer',
            'sellingPrice' => 'required|integer',
            'quantity' => 'required|integer',
            'picture' => 'required|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $temp=true;

        if($req->file('picture')){
            $image = $req->file('picture');
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(250, 300);  
            $image_resize->save(public_path('images/product/'.$filename));
            $image = base64_encode($image_resize);
        }else{
            $image = $user->picture;
            $temp=false;
        }

        $product = new Product;
        
        $product->productName = $req->productName;
        $product->description = $req->description;
        $product->categoryId = $req->category;
        $product->buyingPrice = $req->buyingPrice;
        $product->sellingPrice = $req->sellingPrice;
        $product->quantity = $req->quantity;
        $product->picture = $image;

        $query = $product->save();

        if($query){
            return back()->with('success', 'Product added successful');
        }else{
            return back()->with('fail', 'Submission failed');
        }

    } 

    function CustomizeProduct(Request $req){

        $id = $req->id;
        $category = $req->category;
       
        if( $req->category ){
            $totalRow = Product::where('categoryId', '=', $category)->count();
        }else{
            $totalRow = Product::count();
        }
        $total=$totalRow;
        $totalRow = floor($totalRow/5);

        if($total>25){
            if($id==0 || $id==1){
                $startPoint=2;
            }
            if($id!=1 && $id!=$totalRow && $id>=2 && $id<=$totalRow-3){
                if($id==2){
                    $startPoint=$id;
                }else{
                    $startPoint=$id-1;
                }
            }else{
                if($id<=$totalRow && $id>$totalRow-3){
                    $startPoint=$totalRow-3;
                }
            }
        }else{
            $startPoint=1;
        }

        if($total>0){
            $firstId=Product::first()->categoryId;
            $lastId=Product::latest()->first()->productId;

            $product = Product::skip(($id-1)*5)->take(5)->get();
            $category = Category::all();
            $countbycategory = Product::where('categoryId', '=', $req->category)->count();

            if($req->category && $countbycategory>0){
                $product = Product::where('categoryId', '=', $req->category)->take(5)->get();
                //return $req->category;
                return view('Admin.CustomizeProduct', ['product' => $product, 'startPoint' => $startPoint, 'totalRow' => $totalRow, 'clickedId' =>$id, 'total' => $total, 'category' => $category ]);
            }

            return view('Admin.CustomizeProduct', ['product' => $product, 'startPoint' => $startPoint, 'totalRow' => $totalRow, 'clickedId' =>$id, 'total' => $total, 'category' => $category ]);
        }

        return back();

        //$product = Product::all();
        //$totalRow = Product:: count();
        //return view('Admin.CustomizeProduct', ['product' => $product, 'totalRow' => $totalRow]);

    }

    function BlockedProduct(Request $req){

        $id = $req->id;

        $totalRow = Product::where('quantity' ,'<', 0)
                    ->count();
        
        if($totalRow==0){
            return redirect()->route('CustomizeProduct', ['id' => 0])->with('fail', "No Blocked Product Found");
        }

        $total=$totalRow;
        $totalRow = floor($totalRow/5);

        if($total>25){
            if($id==0 || $id==1){
                $startPoint=2;
            }
            if($id!=1 && $id!=$totalRow && $id>=2 && $id<=$totalRow-3){
                if($id==2){
                    $startPoint=$id;
                }else{
                    $startPoint=$id-1;
                }
            }else{
                if($id<=$totalRow && $id>$totalRow-3){
                    $startPoint=$totalRow-3;
                }
            }
        }else{
            $startPoint=1;
        }

        if($total>0){
            $firstId=Product::first()->categoryId;
            $lastId=Product::latest()->first()->productId;

            $category = Category::all();

            $product = Product::where('quantity' ,'<', 0)->skip(($id-1)*5)->take(5)->get();

            return view('Admin.CustomizeProduct', ['product' => $product, 'startPoint' => $startPoint, 'totalRow' => $totalRow, 'clickedId' =>$id, 'total' => $total, 'category' =>$category ]);
        }

        return back();

        //$product = Product::all();
        //$totalRow = Product:: count();
        //return view('Admin.CustomizeProduct', ['product' => $product, 'totalRow' => $totalRow]);

    }

    function UpdateProduct($id){

        $product = Product::find($id);

        $category = Category::all();

        return view('Admin.UpdateProduct', ['product' => $product, 'category' => $category]);

    }

    function UpdatedProduct($id, Request $req){

        $req->validate([
            'productName' => 'required|string',
            'description' => 'required|string',
            'buyingPrice' => 'required|integer',
            'sellingPrice' => 'required|integer',
            'quantity' => 'required|integer',
            'picture' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);

        $product = Product::find($id);

        $temp=true;
        $pictureError = "";
        if($req->file('picture')){
            $image = $req->file('picture');
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(250, 300);  
            $image_resize->save(public_path('images/product/'.$filename));
            $image = base64_encode($image_resize);
        }else{
            $image = $product->picture;
            $temp=false;
            $pictureError = "This picture field is required";
        }
        
        $product->productName = $req->productName;
        $product->description = $req->description;
        $product->categoryId = $req->category;
        $product->buyingPrice = $req->buyingPrice;
        $product->sellingPrice = $req->sellingPrice;
        $product->quantity = $req->quantity;
        $product->picture = $image;

        $query = $product->save();
        if($query){
            return back()->with('success', 'Product added successful');
        }else{
            return back()->with('fail', 'Submission failed');
        }

        $product = Product::find($id);

        $category = Category::all();

        return view('Admin.UpdateProduct', ['product' => $product, 'category' => $category]);

    }

}
