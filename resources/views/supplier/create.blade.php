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
    <title>Create Customer</title>
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
<body>
    <<div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Create Supplier</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('supplier.index') }}" class="btn btn-primary">Back to Suppliers</a>
            </div>
        </div>
        <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number: </label>
                <input type="number" class="form-control" id="contact" name="contact" required>
                <div id="error-message" class="error-message"></div>
            </div>
            
            <button type="submit" class="btn btn-primary">Create Supplier</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</body>
</html>
</x-app-layout>
