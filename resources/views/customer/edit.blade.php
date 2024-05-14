<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    @include('layouts.navigation1')

    
<!DOCTYPE html>
<html lang="en">
<head>

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
    .error-message {
            color: red;
     }
</style>
</head>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Edit Customer</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('customer.index') }}" class="btn btn-primary">Back to Customers</a>
            </div>
        </div>
        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}">
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" value="{{ $customer->contact }}">
                <div id="error-message" class="error-message"></div>
            </div>
    
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </form>
    </div>
    <script>
        var contactInput = document.getElementById("contact");
        var errorElement = document.getElementById("error-message");

        contactInput.addEventListener("input", function() {
            var contactValue = this.value;
            if (contactValue.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });

        contactInput.addEventListener("keydown", function(event) {
            if (this.value.length >= 10 && event.keyCode !== 8 && event.keyCode !== 46) {
                event.preventDefault();
                errorElement.textContent = "Maximum 10 digits allowed.";
            } else {
                errorElement.textContent = "";
            }
        });
    </script>
</x-app-layout>