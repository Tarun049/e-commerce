<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('product_quantity');

        //function to generate random cart key
        $n = 21;
        function getName($n)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            return $randomString;
        }

        $temp_cart_json = array(
            $product_id => $product_quantity,
        );

        // Session::flush();
        if (!Session::has('product_cart')) {
            if (!Session::has('cart_key')) {
                $cart_key = getName($n);
                Session::put('product_cart', $temp_cart_json);
                Session::put('cart_key', $cart_key);
                return json_encode(array('status' => 'success'));
            } else {
                Session::put('product_cart', $temp_cart_json);
                return json_encode(array('status' => 'success'));
            }
        } else {
            if (Session::has('cart_key')) {
                Session::put('product_cart', $temp_cart_json);
                return json_encode(array('status' => 'success'));
            } else {
                return json_encode(array('status' => 'success'));
            }
        }
    }

    public function productsOnCart(){
        return view('cart');
    }
}