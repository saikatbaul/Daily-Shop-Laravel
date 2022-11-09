<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Category;

class eachCartPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $products = Product::all();
        $productCategory = Category::leftJoin('products', 'categories.categoryId', '=', 'products.categoryId')
                            ->select('products.categoryId','categories.categoryName')
                            ->whereNotNull('products.categoryId')
                            ->distinct()
                            ->get();
        View::share('products', $products);
        View::share('productCategory', $productCategory);
        return $next($request);
    }
}
