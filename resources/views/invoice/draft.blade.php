<x-app-layout>
    {{-- Include navigation or header if needed --}}
    @include('layouts.navigation1')
    <meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>All Products</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<style>
    /* Additional custom styles */
    .container {
        margin-top: 50px;
    }
    .producttable{
           margin-top: 10px;
        }
    
        
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Generate Invoice</div>
                    <div class="card-body">
                        <!-- Select Customer Section -->
                        <div class="form-group row">
                            <label for="customer" class="col-sm-3 col-form-label">Select Customer:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="searchBox" placeholder="Search customers...">
                                <input type="hidden" id="customer_id"> <!-- Hidden field to store the selected customer ID -->
                                <ul id="customerList" class="list-group mt-2"></ul> <!-- List to display search results -->
                            </div>
                        </div>
                        <!-- Add Product Section -->
                        <form id="addProductForm">
                            <div class="form-row align-items-center">
                                <div class="col-md-4">
                                    <select id="product" class="form-control" name="product" required onchange="focusQuantity()">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="qty" min="1" id="qty">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="addProductBtn" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>

                        <!-- Product Table -->
                        <table class="producttable" >
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                
                            </tbody>
                        </table>

                        <!-- Confirm Invoice Section -->
                        <div class="text-center">
                            <button id="confirmInvoiceBtn" class="btn btn-success final">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#searchBox').keyup(function() {
            var query = $(this).val();
            console.log(query);
            if(query != '') {
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


    
    function focusQuantity() {
                     document.getElementsByName('quantity')[0].focus();
                }
            document.getElementById('addProductBtn').addEventListener('click', function(event) {
            event.preventDefault();

            var productId = document.getElementById('product').value;
             console.log(productId);

              var quantity = document.getElementsByName('quantity').value;
                var qty=document.getElementById('qty').value;
          console.log('quantity',qty);
            $.ajax({
                url: '{{ route('get-product-details') }}',
                method: 'GET',
                data: {
                    productId: productId,
                    quantity: qty
                },
                beforeSend: function () {
                    // Show loader if needed
                },
                success: function (data) {
                    console.log(data);
                    updateTable(data);
                },
                error: function (error) {
                    console.log('Error fetching data:', error);
                },
                complete: function () {
                    // Hide loader if needed
                }
            });
        });

        function updateTable(data) {
    var productsData = data.products;
    console.log(productsData);

    var tableBody = document.getElementById('productTableBody');
    var row = tableBody.insertRow();

    row.innerHTML = `
        <td class="font_color row_padding">${productsData.id}</td>
        <td class="font_color row_padding">${productsData.name}</td>
        <td class="font_color row_padding" contenteditable="true">${productsData.unitprice}</td>
        <td class="font_color row_padding">${data.quantity}</td>
        <td id="tot" class="font_color row_padding">${productsData.unitprice * data.quantity}</td>
        <td class="font_color row_padding"><button onclick="deleteRow(this)">Delete</button></td>
    `;

    var tot = 0;

    document.querySelectorAll('#productTableBody tr').forEach(function(row) {
        var totalPriceCell = row.querySelector('#tot');
        if (totalPriceCell) {
            var totalPriceCellContent = totalPriceCell.textContent;
            console.log(totalPriceCellContent);
            tot += parseFloat(totalPriceCellContent);
        }
    });

    // console.log('Total:', tot);
    // updateAmount(tot);
    // var totalRow = tableBody.insertRow();
    // totalRow.innerHTML = `
    //     <td hidden>Total:</td>
    //     <td id="sum" colspan="3" " hidden>${tot}</td>

    // `;

}

document.addEventListener('DOMContentLoaded', function() {
            var final = document.querySelector('.final');
            if (final) {
                final.addEventListener('click', function(event) {
                    event.preventDefault();
                    var customer=document.getElementById('customer_id').value;
                    console.log(customer);
                    // Gather data from the table
                    var tableRows = document.querySelectorAll('#productTableBody tr');
                    var rowData = [];
            tableRows.forEach(function(row) {
                // Check if enough cells exist in the row
                if (row.cells.length >= 6) {
                    var Product_id = row.cells[0].textContent.trim();
                    var ProductName = row.cells[1].textContent.trim();
                    var unitprice = row.cells[2].textContent.trim();
                    var quantity = row.cells[3].textContent.trim();
                    var totalprice = row.cells[4].textContent.trim();

                    console.log('Row data:', { Product_id: Product_id, unitprice: unitprice, quantity: quantity, totalprice: totalprice }); // Log each row's data

                    rowData.push({  Product_id: Product_id, unitprice: unitprice, quantity: quantity, totalprice: totalprice });
                } else {
                    console.warn('Row skipped due to insufficient cells:', row);
                }
            });
            console.log('Data to be sent:', rowData); // Log the data to be sent

// Send data to the controller via AJAX
                        $.ajax({
                            url: '{{ route('invoiceDraft') }}', // Route name for Laravel
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: { data: JSON.stringify(rowData),
                                customer: customer
                               
                            },
                            beforeSend: function() {
                                // Show loader or perform any pre-AJAX actions
                            },
                            success: function(response) {
                                console.log('Server response:', response);
                               
                                alert('Data added successfully!');
                                window.location.href = '{{ route('invoice.draft') }}';
                            },
                            error: function(xhr, status, error) {
                                console.error('Error sending data:', error);
                                console.log('Server response:', xhr.responseText); // Log the server response
                                // Handle error if needed
                            },
                            complete: function() {
                                // Hide loader or perform any post-AJAX actions
                            }
                        });

                });
            }
        });
        
        $('#checkout').on('click', function() {
    $.ajax({
        url: '{{ route('getProductDraftData') }}', // Route to fetch product draft data
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            customerId: lastInvoiceCustomerId // Pass the last invoice's customer ID
        },
        beforeSend: function() {
            // Show loader or perform any pre-AJAX actions
        },
        success: function(data) {
            console.log('Product draft data:', data);
            // Clear existing rows in the table
            $('#productTableBody').empty();
            // Append new rows with fetched data
            data.forEach(function(row) {
                $('#productTableBody').append(`
                    <tr>
                        <td>${row.product_id}</td>
                        <td>${row.product_name}</td>
                        <td>${row.unit_price}</td>
                        <td>${row.quantity}</td>
                        <td>${row.total_price}</td>
                        <td><button class="btn btn-danger">Delete</button></td>
                    </tr>
                `);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            console.log('Server response:', xhr.responseText); // Log the server response
            // Handle error if needed
        },
        complete: function() {
            // Hide loader or perform any post-AJAX actions
        }
    });
});

    </script>
</x-app-layout>
