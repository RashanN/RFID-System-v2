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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/invoiceshow.css')}}">
    <!-- Custom CSS -->
    <style>
        /* Additional custom styles */
        .container {
            margin-top: 50px;

        }
        .col-md-6 {
        margin-bottom: 5px;
        }
        .producttable{
           margin-top: 10px;
        }
    </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invoice Details</div>
                <div class="card-body">
                    <script>
                        // Define JavaScript variables to store the products and amount

                    </script>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Played Time Total:</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="played_time_total" value="{{ $total }}" class="form-control" style="font-weight: 700" autofocus>
                        </div>
                    </div>


                    <!-- Bought Products Table (Assuming some sample data) -->
                    <h3>Bought Products</h3>
                    <form id="addProductForm" method="POST" action="">
                        @csrf
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
                                {{-- <input type="number" class="form-control" name="quantity" min="1" id="quantity"> --}}
                                <input type="number" class="form-control" name="qty" min="1" id="qty">
                            </div>

                            <div class="col-md-2">

                                <button type="button" id="addProductBtn" class="btn btn-primary">Add</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="checkout" class="btn btn-primary">Checkout</button>
                            </div>
                        </div>
                    </form>

                    <table class="producttable">
                        <!-- Table header -->
                        <thead>
                            <tr>
                                <th>ProductID</th>
                                <th>Product Name</th>
                                <th>Sale Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <!-- Table body (sample data) -->
                        <tbody id="productTableBody">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                    <div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Amount</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="amount" id="amount"  class="form-control input-with-border" >
                        </div>
                        <div class="col-md-6">
                            <h6>Discount</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="discount"  class="form-control input-with-border" id="discount" value="0.00">
                        </div>
                        <div class="col-md-6">
                            <h6>Fine Payment</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="fine"  class="form-control input-with-border" id="fine" value="0.00">
                        </div>
                        <div class="col-md-6">
                            <h6>Total</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="total" id="total" class="form-control input-with-border" >
                        </div>
                        <div class="col-md-6">
                            <h6>Cash</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="cash" id="cash" class="form-control input-with-border">
                        </div>
                        
                        <div class="col-md-6">
                            <h6>Balance</h6>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="balance" id="balance" class="form-control input-with-border" readonly>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6" style="align-items: center;text-align: center">
                        <a href="" class="btn btn-danger final">Print</a>

                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
      <script>

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

    console.log('Total:', tot);
    updateAmount(tot);
    var totalRow = tableBody.insertRow();
    totalRow.innerHTML = `
        <td hidden>Total:</td>
        <td id="sum" colspan="3" " hidden>${tot}</td>

    `;

}

        function deleteRow(button) {
            var row = button.parentNode.parentNode; // Get the parent row of the button
            row.parentNode.removeChild(row); // Remove the row from the table
            updateAmount();
        }

        function updateAmount(tot) {

                var playedTimeTotalValue = document.getElementsByName('played_time_total')[0].value;
                document.getElementsByName('amount')[0].value=parseFloat(playedTimeTotalValue);

                    var tot = 0;
                    document.querySelectorAll('#productTableBody tr').forEach(function(row) {
                    var totalPriceCell = row.querySelector('#tot');
                    if (totalPriceCell) {
                            var totalPriceCellContent = totalPriceCell.textContent;
                            tot += parseFloat(totalPriceCellContent);
                    }
                    var discount=document.getElementById('discount').value;
                    var fine=document.getElementById('fine').value;
                    var amount = parseFloat(playedTimeTotalValue) + tot;
                    amount = amount.toFixed(2);
                    document.getElementsByName('amount')[0].value = amount;

                    var total=amount-parseFloat(discount)+parseFloat(fine);
                    total=parseFloat(total);
                    document.getElementsByName('total')[0].value = total;

    });



            }
            updateAmount();
            document.getElementsByName('played_time_total')[0].addEventListener('input', function() {
                updateAmount(); // Update the amount input field when played_time_total changes
            });
            document.getElementsByName('discount')[0].addEventListener('input', function() {
                updateAmount(); // Update the amount input field when played_time_total changes
            });
            document.getElementsByName('fine')[0].addEventListener('input', function() {
                updateAmount(); // Update the amount input field when played_time_total changes
            });

////////////////////////////////////////checkout option

            $(document).ready(function(){
                $("#checkout").click(function(){
                    // Perform AJAX request to fetch data from the server
                    $.ajax({
                        url: "fetchProductDraftData", // Replace with your backend endpoint
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Clear existing table rows
                          //  $("#productTableBody").empty();
                            console.log(data);
                            // Populate table with fetched data
                            if (data.length === 0) {
                    // If data is empty, display a message
                    alert("No pre orders");
                } else {
                    // Populate table with fetched data
                    $.each(data, function(index, item) {
                        var row = "<tr>" +
                                    "<td>" + item.product_id + "</td>" +
                                    "<td>" + item.product.name + "</td>" +
                                    "<td>" + item.product.unitprice + "</td>" +
                                    "<td>" + item.quantity + "</td>" +
                                    "<td id='tot'>" + item.amount + "</td>" +
                                    "<td class='font_color row_padding'><button onclick='deleteRow(this)'>Delete</button></td>" +
                                "</tr>";
                        $("#productTableBody").append(row);
                    });
                    updateAmount();
                }
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error(xhr.responseText);
                        }
                    });
                });
            });


////////////////////////////////////////////////////////////
            document.addEventListener('DOMContentLoaded', function() {
            var final = document.querySelector('.final');
            if (final) {
                final.addEventListener('click', function(event) {
                    event.preventDefault();
                    var discount=document.getElementById('discount').value;
                    console.log(discount);
                    var fine=document.getElementById('fine').value;
                    console.log(fine);
                    var total=document.getElementById('total').value;
                    console.log(total);

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
                            url: '{{ route('invoiceGenerator') }}', // Route name for Laravel
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: { data: JSON.stringify(rowData),
                                discount: discount,
                                fine: fine,
                                total:total

                            },
                            beforeSend: function() {
                                // Show loader or perform any pre-AJAX actions
                            },
                            success: function(response) {
                                console.log('Server response:', response);
                                var invoiceId = response.invoiceId;
                                window.location.href = '{{ route('invoice.bill') }}?invoice=' + invoiceId;

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
        $(document).ready(function () {
    // Function to calculate and update balance
    function updateBalance() {
        var total = parseFloat($('#total').val()) || 0;
        var cash = parseFloat($('#cash').val()) || 0;
        var balance = cash - total;
        $('#balance').val(balance.toFixed(2)); // Update balance field
    }

    // Update balance when Enter key is pressed
    $('#total, #cash').on('keypress', function (e) {
        if (e.which === 13) { // Check if Enter key is pressed
            updateBalance();
        }
    });
});

    </script>
</x-app-layout>
