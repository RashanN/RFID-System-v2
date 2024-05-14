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
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>All Products</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<meta name="csrf_token" content="{{ csrf_token() }}" />
<!-- Custom CSS -->
<style>
    /* Additional custom styles */
    .container {
        margin-top: 50px;
    }
</style>
</head>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Invoice</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf


                            <!-- Customer ID -->
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label text-md-right">Customer</label>
                                    {{-- <div class="col-md-6">
                                        <select id="customer_id" class="form-control" name="customer_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        </div> --}}


                                        <div style="display: flex; align-items: center;">
                                            <input type="text" id="searchBox" placeholder="Search customers...">
                                            <input type="hidden" id="customer_id"> <!-- Hidden field to store the selected customer ID -->
                                            <a href="{{ route('customer.create') }}" class="btn btn-secondary" style="margin-left: 10px;" target="_blank">+</a>
                                        </div>


                                </div>
                                <div class="form-group row justify-content-center">
                                    <ul id="customerList"></ul>



                                </div>
                                <div class="form-group row justify-content-center">
                                    <a href="#" id="conformButton" class="btn btn-success">Confirm</a>
                                </div>
                                <div id="textBoxContainer"></div>

                                <div class="form-group row justify-content-center">
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" style="border: 1px solid #ced4da;" placeholder="RFID" id="RFID">
                                            </div>
                                            <div class="col">
                                                <select class="form-control" id="childNames" class="childNames">
                                                    
                                                </select>

                                            </div>
                                            <div class="col">
                                                <select class="form-control" id="pricerange" class="pricerange">
                                                    <option value="">Select Range</option>
                                                    <option value="Kids">Kids</option>
                                                    <option value="Toddler">Toddler</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" style="border: 1px solid #ced4da;"  id="status" readonly>
                                            </div>
                                            <div class="col">
                                                <a href="#" id="addBtn" class="btn btn-success">Add</a>
                                                <a href="{{ route('child.create') }}" class="btn btn-secondary"   target="_blank">+</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <!-- Playtime Price -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h3>Playtime Price</h3>
                                    <table id="playtime-table" class="table">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Child Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Played Time </th>
                                                <th>Amount</th>

                                            </tr>
                                        </thead>
                                        <!-- Table body (data should come from controller) -->
                                        <tbody id="PlaytimeBody">
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Amount</h4>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="amount" id="amount" class="form-control input-with-border">

                            </div>
                        </div>
                            <a href="" class="btn btn-danger generate-btn">Generate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>

    var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;

    document.getElementById("conformButton").addEventListener("click", function() {
        var customerId = document.getElementById("customer_id").value;
        console.log(customerId);

        fetch("{{ route('fetch.children') }}?customerId=" + customerId)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                renderChildFields(data);
            })
            .catch(error => console.error('Error:', error));


    });

                document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("conformButton").addEventListener("click", function() {
                    var customerId = document.getElementById("customer_id");
                    customerId.disabled = true;
                });
            });

        function renderChildFields(children) {

        var childNamesSelect = document.getElementById("childNames");
        childNamesSelect.innerHTML = "";


        if (children && children.length > 0) {
            var option = document.createElement("option");
            option.value = "Select child";
            option.textContent = "Select Child";
            childNamesSelect.appendChild(option);
        children.forEach(child => {
            var option = document.createElement("option");
            option.value = child.id;
            option.textContent = child.name;
            childNamesSelect.appendChild(option);
        });
        } else {
            var option = document.createElement("option");
            option.value = "no child";
            option.textContent = "No Child";
            childNamesSelect.appendChild(option);
        }
    }

    document.getElementById('addBtn').addEventListener('click', function(event) {
            event.preventDefault();

            var addBtnRect = document.getElementById('addBtn').getBoundingClientRect();
            var addBtnTop = addBtnRect.top + window.scrollY;
            var addBtnLeft = addBtnRect.left + window.scrollX;
          //  var confirmation = confirm("Are you sure you want to proceed?", addBtnLeft, addBtnTop);
    
    // Proceed only if the user confirms
            // if (confirmation) {

            var rfid = document.getElementById('RFID').value;
             console.log('dsdsd',rfid);
             var childName = document.getElementById('childNames').value;
              console.log('SDSD',childName);
              var pricerange= document.getElementById('pricerange').value;
             console.log('hghg',pricerange);

            $.ajax({
            url: '{{ route('get-time') }}',
            method: 'GET',
            data: {
                rfid: rfid,
                childName: childName,
                pricerange: pricerange
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
                alert('Wrong input');
            },
            complete: function () {
                // Hide loader if needed
            }
        });
           // } else {
        // User canceled, do nothing
           // }
        });

        function updateTable(data) {
    var childData = data.child;
    console.log('farm',childData);

    var tableBody = document.getElementById('PlaytimeBody');
    var row = tableBody.insertRow();

    row.innerHTML = `
        <td class="font_color row_padding">${today}</td>
        <td class="font_color row_padding">${childData ? childData.name : 'null'}</td>
        <td class="font_color row_padding">${data.intime.intime}</td>
        <td class="font_color row_padding">${data.outtime.outtime}</td>
        <td class="font_color row_padding">${data.playedtime}</td>
        <td id="tot" class="font_color row_padding">${data.amountprice}</td>

    `;
    var childId = childData ? childData.id : null;
    var tot = 0;

    document.querySelectorAll('#PlaytimeBody tr').forEach(function(row) {
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
    function updateAmount(tot) {

            var tot = 0;
            document.querySelectorAll('#PlaytimeBody tr').forEach(function(row) {
            var totalPriceCell = row.querySelector('#tot');
            if (totalPriceCell) {
                    var totalPriceCellContent = totalPriceCell.textContent;
                    tot += parseFloat(totalPriceCellContent);
            }
            var amount = tot;
            amount = amount.toFixed(2);
            document.getElementsByName('amount')[0].value = amount;
        });


        }

        document.addEventListener('DOMContentLoaded', function() {
    var generateBtn = document.querySelector('.generate-btn');
    if (generateBtn) {
        generateBtn.addEventListener('click', function(event) {
            event.preventDefault();

            var customerId = document.getElementById("customer_id").value || null;
            var rfid = document.getElementById('RFID').value || null;
            var child_id = document.getElementById('childNames').value || null;
            var total = document.getElementById('amount').value || null;

            // Gather data from the table
            var tableRows = document.querySelectorAll('#PlaytimeBody tr');
            var rowData = [];
            tableRows.forEach(function(row) {
                // Check if enough cells exist in the row
                if (row.cells.length >= 4) {
                    var childName = row.cells[1].textContent.trim();
                    var intime = row.cells[2].textContent.trim();
                    var outtime = row.cells[3].textContent.trim();
                    var amount = row.cells[5].textContent.trim();

                    if (childName == '') childName = null;
                    if (intime == '') intime = null;
                    if (outtime == '') outtime = null;
                    if (amount == '') amount = null;

                    console.log('Row data:', { childName: childName, intime: intime, outtime: outtime, amount: amount, customerId: customerId, rfid: rfid, child_id: child_id }); // Log each row's data

                    rowData.push({ childName: childName, intime: intime, outtime: outtime, amount: amount, customerId: customerId, rfid: rfid, child_id: child_id });
                } else {
                    console.warn('Row skipped due to insufficient cells:', row);
                }
            });

            console.log('Data to be sent:', rowData); // Log the data to be sent

            // Send data to the controller via AJAX
            $.ajax({
                url: '{{ route('playTimeOrder') }}', // Route name for Laravel
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: { data: JSON.stringify(rowData),
                    total: total,
                    customerId: customerId
                },
                beforeSend: function() {
                    // Show loader or perform any pre-AJAX actions
                },
                success: function(response) {
                    console.log('Server response:', response);
                    var totalAmount = response.total;
                    window.location.href = '{{ route('invoice.show') }}?totalAmount=' + totalAmount;

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

       // search for customer
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


    function openCreateCustomerModal() {
        // Fetch the content of the customer create blade using AJAX
        $.ajax({
            url: "{{ route('customer.create') }}",
            success: function(response) {
                // Create a Bootstrap modal and append the blade content to it
                var modal = $('<div class="modal fade" tabindex="-1" role="dialog">' +
                                '<div class="modal-dialog" role="document">' +
                                    '<div class="modal-content">' +
                                        '<div class="modal-body">' + response + '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>');

                // Append the modal to the body and show it
                $('body').append(modal);
                modal.modal('show');
            }
        });
    }

    // Event listener for the button click
    $(document).on('click', '#createCustomerButton', function() {
        openCreateCustomerModal();
    });

    $(document).ready(function() {
        // On change event of the select element
        $('#childNames').change(function() {
            // Get the selected child ID
            var childId = $(this).val();
            console.log('rashan child ', childId);
            // AJAX request to fetch status of the selected child
            $.ajax({
                url: '/get-status', // Endpoint to fetch status (replace with actual endpoint)
                type: 'GET',
                data: {
                    child_id: childId
                },
                success: function(response) {
                    // Set the fetched status to the status input field
                    $('#status').val(response.status);
                    console.log('seerver responce ', response)
                },
                error: function(xhr, status, error) {
                    console.error(error); // Log any errors
                }
            });
        });
    });
    /////////////////http://127.0.0.1:8000/invoice/generate/1h%2056m/2/11:52

    </script>

