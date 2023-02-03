<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.addProduct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $validate = $request->validate([
            'product-name' => 'required',
            'product-price' => 'required',
            'product-quantity' => 'required',
            'product-image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validate) {
            // $imageName = time().'.'.$request->image->extension();
            // $request->image->move(public_path('img'), $imageName);

            $imageName = time() . '.' . $request->file('product-image')->getClientOriginalExtension();
            $request->file('product-image')->move(public_path('admin/images/products'), $imageName);

            $product_data = new Product;
            $product_data->name = $request->input('product-name');
            $product_data->desc = $request->input('product-description');
            $product_data->quantity = $request->input('product-quantity');
            $product_data->price = $request->input('product-price');
            $product_data->image = $imageName;
            $product_data->SKU = 'null';
            $product_data->category_id = 0;
            $product_data->tag_id = 0;
            $status = $product_data->save();

            if ($status) {
                return redirect()->route('add_product')->with("status", "Product Add Succesfully");
            } else {
                return redirect()->route('add_product')->with("status-error", "Something Went Worng !! Try Again");
            }
        }
    }

    public function showProducts()
    {
        $all_products = Product::all();
        // $all_products = Product::paginate(4);

        return view("admin.showProducts", ["product_list" => $all_products]);

        // if( !empty($all_products) && is_array( $all_products ) ) {
        //     return view("admin.showProducts", ["product_list" => $all_products]);
        //     // return view("updateUserMember",["userData" =>$data]);
        // } else {
        //     $all_products = '';
        //     return view('admin.showProducts', array(['product_list' => $all_products]));
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product_data = Product::find($id);
        return view('admin.updateProduct', ["product_data" => $product_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validate = $request->validate([
            'product-name' => 'required',
            'product-price' => 'required',
            'product-quantity' => 'required',
            'product-image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($validate) {
            $imageName = time() . '.' . $request->file('product-image')->getClientOriginalExtension();
            $request->file('product-image')->move(public_path('admin/images/products'), $imageName);

            $product_id = $request->input('product_id');

            $product_data = Product::find($product_id);
            $product_data->name = $request->input('product-name');
            $product_data->desc = $request->input('product-description');
            $product_data->quantity = $request->input('product-quantity');
            $product_data->price = $request->input('product-price');
            $product_data->image = $imageName;
            $product_data->SKU = 'null';
            $product_data->category_id = 0;
            $product_data->tag_id = 0;
            $status = $product_data->save();

            if ($status) {
                return redirect()->route('show_product')->with("status", "Product Update Succesfully");
            } else {
                return redirect()->route('show_product')->with("status-error", "Something Went Worng !! Try Again");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $status = $product->delete();

            if ($status) {
                return redirect()->route('show_product')->with("delete-success", "Product Deleted");
            } else {
                return redirect()->route('show_product')->with("status-error", "Something Went Worng !! Try Again");
            }
    }
}