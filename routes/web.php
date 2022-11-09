<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminPannelController;
use App\Http\Controllers\CartController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;





/////////////////////>>>>>>>>>>>>>front page<<<<<<<<<<<<<////////////////////


Route::get('/', function () {

    $category=Category::all();
    $product=Product::all();
    $admin=Admin::where('userName','arefin101')->first();
    //return $admin;

    $productCategory = Category::leftJoin('products', 'categories.categoryId', '=', 'products.categoryId')
                        ->select('products.categoryId','categories.categoryName')
                        ->whereNotNull('products.categoryId')
                        ->distinct()
                        ->get();
    return view('index', ['category' => $category, 'product' => $product, 'productCategory' => $productCategory, 'admin' => $admin ] );


})->name('index');






/////////////////////>>>>>>>>>>Authentication Part<<<<<<<<<<////////////////////


Route::middleware('AllreadyLoggedin')->group(function(){
    Route::get("register", [UserAuthController::class, "register"])->name('register')->middleware('eachCartPage');;
    Route::post("register", [UserAuthController::class, "registered"])->name('registered')->withoutMiddleware('AllreadyLoggedin');
    Route::get("login", [UserAuthController::class, "login"])->name('login')->middleware('eachCartPage');
    Route::post('login', [UserAuthController::class, 'check'])->name('check')->withoutMiddleware('AllreadyLoggedin');
});

Route::get('login_with_facebook', [UserAuthController::class, 'facebookRedirect'])->name('LoginWithFacebook');
Route::get('login_with_facebook/callback', [UserAuthController::class, 'loginWithFacebook']);
Route::get('login_with_google', [UserAuthController::class, 'googleRedirect'])->name('LoginWithGoogle');
Route::get('login_with_google/callback', [UserAuthController::class, 'loginWithGoogle']);

Route::get("logout", [UserAuthController::class, "logout"])->name('logout');






/////////////////////>>>>>>>>>>>>Admin Part<<<<<<<<<<////////////////////


Route::middleware('IsLogged')->group(function () {
    Route::get('Home', [AdminPannelController::class, 'home'])->name('Home');
    Route::get('Admin_Profile', [AdminPannelController::class, 'profile'])->name('ProfileSettings');
    Route::get('Change_Password', [AdminPannelController::class, 'ChangePassword'])->name('ChangePassword');
    Route::post('Changed_Password', [AdminPannelController::class, 'ChangedPassword'])->name('ChangedPassword');
    Route::get('viewprofile', [AdminPannelController::class, 'ViewProfile'])->name('ViewProfile');
    Route::post('Update_Profile', [AdminPannelController::class, 'UpdateProfile'])->name('UpdateProfile');
    Route::Get('upload_photo', [AdminPannelController::class, 'UploadPhoto'])->name('UploadPhoto');
    Route::Post('upload_photo', [AdminPannelController::class, 'UploadedPhoto'])->name('UploadedPhoto');
    Route::Get('add_category', [AdminPannelController::class, 'AddCategory'])->name('AddCategory');
    Route::Post('added_category', [AdminPannelController::class, 'AddedCategory'])->name('AddedCategory');
    Route::Get('customize_category', [AdminPannelController::class, 'CustomizeCategory'])->name('CustomizeCategory');
    Route::Get('add_product', [AdminPannelController::class, 'AddProduct'])->name('AddProduct');
    Route::Post('added_product', [AdminPannelController::class, 'AddedProduct'])->name('AddedProduct');
    Route::Get('customize_product', [AdminPannelController::class, 'CustomizeProduct'])->name('CustomizeProduct');
    Route::Get('customize_product', [AdminPannelController::class, 'CustomizeProduct'])->name('CustomizeProduct');
    Route::Get('blocked_product', [AdminPannelController::class, 'BlockedProduct'])->name('BlockedProduct');
    Route::Get('update_product/{id}', [AdminPannelController::class, 'UpdateProduct'])->name('UpdateProduct');
    Route::Post('updated_product/{id}', [AdminPannelController::class, 'UpdatedProduct'])->name('UpdatedProduct');
});

    


/////////////////////>>>>>>>>>>>>Customer Part<<<<<<<<<<////////////////////


Route::middleware('eachCartPage')->group( function(){

    Route::get("product_detail", [CartController::class, 'ProductDetail'])->name('ProductDetail');
    Route::post("product_detail", [CartController::class, 'ProductDetails'])->name('ProductDetails');
    Route::get("cart", [CartController::class, 'Cart'])->name('Cart');
    Route::post("cart", [CartController::class, 'UpdateCart'])->name('UpdateCart');
    Route::get("checkout", [CartController::class, 'CheckOut'])->name('CheckOut');
    Route::post("checkout", [CartController::class, 'PlaceOrder'])->name('PlaceOrder');

} );


