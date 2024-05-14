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
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>All Product Categories</h2>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('product_category.create') }}" class="btn btn-success">Add New Category</a>
        </div>
    </div>
    @if ( $productcategories->isEmpty())
    <p>No product categories found.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $productcategories as $productCategory)
            <tr>
                <td>{{ $productCategory->name }}</td>
                <td>
                    <a href="{{ route('product_category.edit', $productCategory->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('product_category.destroy', $productCategory->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</x-app-layout>
    