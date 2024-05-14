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
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Create Customer</h2>
                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name: *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    --}}
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" >
                    </div>

                    <div class="form-group">
                        <label for="contact_number">Contact Number: </label>
                        <input type="number" class="form-control" id="contact" name="contact" >
                        <div id="error-message" class="error-message"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Customer</button>
                </form>
            </div>
        </div>
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
