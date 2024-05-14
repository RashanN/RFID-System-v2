<x-app-layout>
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
        </style>
    </head>
    <body>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Create New Child</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('child.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="parent_id">Parent Name:*</label>
                                        <input type="text" id="searchBox" placeholder="Search parents..." class="form-control">
                                        <input type="hidden" id="customer_id" name="customer_id" class="form-control" required> <!-- Hidden field to store the selected customer ID -->
                                    </div>
                                    <div class="form-group ">
                                        <ul id="customerList"></ul>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Child Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Date of Birth *</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender:</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="school">School:</label>
                                        <input type="text" class="form-control" id="school" name="school">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="relationship">Relationship to Parent:</label>
                                        <select class="form-control" id="relationship" name="relationship" >
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Uncle">Uncle</option>
                                            <option value="Aunty">Aunty</option>
                                            <option value="Grand Parent">Grand Parent</option>
                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="status">LifeMember Status</label>
                                        <select class="form-control" id="status" name="status" >
                                            <option value="no">no</option>
                                            <option value="yes">yes</option>

                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#searchBox').keyup(function() {
                    var query = $(this).val();
                    if (query != '') {
                        $.ajax({
                            url: "{{ route('search.customers') }}",
                            method: "POST",
                            data: {query: query, "_token": "{{ csrf_token() }}"},
                            success: function(data) {
                                $('#customerList').empty();
                                $.each(data, function(key, customer) {
                                    $('#customerList').append('<li class="customer" data-id="' + customer.id + '">' + customer.name + '</li>');
                                });
                            }
                        });
                    }
                });

                $(document).on('click', '.customer', function() {
                    var selectedCustomer = $(this);
                    $('#searchBox').val(selectedCustomer.text());
                    $('#customer_id').val(selectedCustomer.data('id')); // Set the selected customer's ID in the hidden field
                    $('#customerList').empty(); // Clear the search results
                });
            });
        </script>
    </body>
    </html>
</x-app-layout>
