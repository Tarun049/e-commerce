@extends('layouts.admin')
@section('content')
    <div class="products-wrapper">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('delete-success'))
            <div class="alert alert-success" role="alert">
                {{ session('delete-success') }}
            </div>
        @endif

        @if (session('status-error'))
            <div class="alert alert-success" role="alert">
                {{ session('status-error') }}
            </div>
        @endif
        <table class="responsive-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_list as $product_key)
                    <tr>
                        <th scope="row">{{ $product_key['name'] }}</th>
                        <td data-title="Released" class="col-sm-2">{{ $product_key['desc'] }}</td>
                        <td data-title="Studio">{{ $product_key['quantity'] }}</td>
                        <td data-title="Worldwide Gross" data-type="currency">{{ $product_key['price'] }}</td>
                        <td data-title="Domestic Gross" data-type="currency">
                            <img id="product_id" src="{{ asset('admin/images/products/' . $product_key['image']) }}">
                        </td>
                        <td data-title="Foreign Gross" data-type="currency">
                            <a href="{{ route('update_product_form', ['product_id' => $product_key['id']]) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ route('delete_product', ['product_id' => $product_key['id']]) }}"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            {{-- {{ $product_list->links() }} --}}
    </div>
@endsection
