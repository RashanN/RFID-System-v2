<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
	@include('layouts.navigation')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Additional custom styles */
        .container {
            margin-top: 50px;
        }
    </style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>All Products</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-success">Add New Product</a>
            </div>
        </div>
        @if(count($products) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Show Price</th>
                        <th>Sale Price</th>
                        <th>Stock Level</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->showprice }}</td>
                            <td>{{ $product->unitprice }}</td>
                            <td>{{ $product->stock_level }}</td>
                            <td>{{ $product->description }}</td>
                               <td>{{ $product->category_name}}</td>
                            <td>{{ $product->supplier_name }}</td>
                            <td>
                                <!-- Edit button with iframe -->
                                <button  class="btn btn-primary">Edit
                                    <a href="{{ route('product.edit', $product->id) }}">Edit</a>

                                </button>
                                {{-- <iframe width="50" height="50" src="{{ route('product.edit', $product->id) }}" srcdoc="<html><body style='margin:0;padding:0;text-align:center;'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path fill='none' d='M0 0h24v24H0V0z'/><path d='M21 3c.55 0 1 .45 1 1v16c0 .55-.45 1-1 1H3c-.55 0-1-.45-1-1V4c0-.55.45-1 1-1h6c.55 0 1-.45 1-1s-.45-1-1-1H3c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-4.41 14.59L12 11.17l-4.59 4.58L6 16l6-6 6 6-1.41 1.41zM4 6h16v2H4z'/></svg></body></html>"></iframe> --}}
                                <!-- Delete button with iframe -->
                                
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No products found.</p>
        @endif
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</x-app-layout>
   