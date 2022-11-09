<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'productId' => 1,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 2,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 3,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 4,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 5,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 6,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 7,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 8,
            'productName' => 'Tshirt1',
            'description' => 'White X size',
            'categoryId' => 1,
            'buyingPrice' => 120,
            'sellingPrice' => 145,
            'quantity' => 100,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 9,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 10,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 11,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 12,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 13,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 14,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 15,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
        DB::table('products')->insert([
            'productId' => 16,
            'productName' => 'Mouse',
            'description' => 'Smart Mouse',
            'categoryId' => 2,
            'buyingPrice' => 450,
            'sellingPrice' => 600,
            'quantity' => 20,
            'picture' => "defaultP.jpg",
        ]);
    }
}
