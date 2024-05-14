<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
	@include('layouts.navigation')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Additional custom styles */
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Create Product</h2>
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <table class="table">
                        <tr>
                            <td><label for="name">Name:</label></td>
                            <td><input type="text" id="name" name="name" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><label for="showprice">Unit Price:</label></td>
                            <td><input type="text" id="showprice" name="showprice" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><label for="unitprice">Sale Price:</label></td>
                            <td><input type="text" id="unitprice" name="unitprice" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><label for="stock_level">Stock Level:</label></td>
                            <td><input type="number" id="stock_level" name="stock_level" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td><label for="description">Description:</label></td>
                            <td><textarea id="description" name="description" class="form-control" rows="3" required></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="product_category_id">Product Category ID:</label></td>
                            <td> <select id="product_category_id" name="product_category_id" class="form-control" required>
                                <option value="">Select Product Category</option>
                                @foreach($productCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select></td>
                        </tr>
                        <tr>
                            <td> <label for="supplier_id">Supplier:</label>
                            <td><select id="supplier_id" name="supplier_id" class="form-control" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</x-app-layout>

