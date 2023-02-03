@extends('layouts.admin')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    </nav>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Update Product</div>
                        <div class="card-body">
                            <form action="{{ route('update_product') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="product_id" value={{$product_data['id']}} >

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Product
                                        Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="Product_name" class="form-control" name="product-name"
                                         value={{$product_data['name']}} autofocus>
                                        <span class="error-message">
                                            @error('product-name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address"
                                        class="col-md-4 col-form-label text-md-right">Description</label>
                                    <div class="col-md-6">
                                        <input type="text" id="product_description" class="form-control"
                                            name="product-description" value={{$product_data['desc']}} autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Price</label>
                                    <div class="col-md-6">
                                        <input type="number" min="0" id="product_price" class="form-control"
                                            name="product-price" value={{$product_data['price']}} autofocus>
                                        <span class="error-message">

                                            @error('product-price')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_address"
                                        class="col-md-4 col-form-label text-md-right">Quantity</label>
                                    <div class="col-md-6">
                                        <input type="number" min="0" id="product_quantity" class="form-control"
                                            name="product-quantity" value={{$product_data['quantity']}} autofocus>
                                        <span class="error-message">
                                            @error('product-quantity')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Image</label>
                                    <div class="col-md-6">
                                        <input type="file" id="product_image" class="form-control" name="product-image"
                                            autofocus>
                                            <img id="product_id" src="{{ asset('admin/images/products/' . $product_data['image']) }}" alt="">
                                            
                                        <span class="error-message">
                                            @error('product-image')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Product
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
@endsection
