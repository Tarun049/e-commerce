<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class WelcomeController extends Controller
{
    //
    public function showHomeProducts(){
        $product_data = Product::all();
        return view('index', ['home_products' => $product_data]);
    }

    public function singleProductDetail($id) {
        $product_data = Product::find($id);
        return view("detail",['product_data' => $product_data]);
    }
}
