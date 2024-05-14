<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
       @media print {
            /* Adjustments for printing */
            body {
                margin: 0;
                padding: 10px;
            }
            .container {
                width: 80mm; /* Set the width for the printer */
                margin: 0 auto;
            }
            .header {
                margin-bottom: 10px;
            }
            .table th, .table td {
                padding: 4px;
                font-size: 10px; /* Adjust font size for table cells */
            }
            .total-section {
                margin-top: 10px;
            }
            .no-print {
                display: none; /* Hide elements not necessary for print */
            }
        }
        /* General styling */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px; /* Set the maximum width for regular view */
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <button onclick="window.location.href='/dashboard'">Back to Dashboard</button>
        <div class="header">
            <img src="/image/bgicon.jpg" alt="Company Logo">
            <h2>House Of Play</h2>
            <p>Lake Road,Boaralesgamuwa</p>
            <p>Company Telephone</p>
            <p><strong></strong> "Thank you for choosing us."</p>
        </div>
        <div class="invoice-details">
            <p><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
            <p><strong>Customer Name:</strong> {{$customerName}}</p>
        </div>

        <div class="playtime-order">
            <h3>Playtime Order</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>In time</th>
                        <th>out time</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($playtimeOrders as $playtimeOrder)
                    <tr>
                        <td>{{ $playtimeOrder->child_name }}</td>
                        <td>{{ $playtimeOrder->intime }}</td>
                        <td>{{ $playtimeOrder->outtime }}</td>
                        <td>{{ $playtimeOrder->amount }}</td>
                        <!-- Add other fields as needed -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="purchase-order">
            <h3>Purchase Order</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseItems as $purchaseItem)
                    <tr>
                        <td>{{ $purchaseItem->product_name }}</td>
                        <td>{{ $purchaseItem->quantity }}</td>
                        <td>{{ $purchaseItem->amount }}</td>
                        <!-- Add other fields as needed -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total-section">
            <p><strong>Discount:</strong> {{ $invoice->discount }}</p>
            <p><strong>Fine:</strong> {{ $invoice->fine}}</p>
            <p><strong>Total:</strong> {{ $invoice->total }}</p>

            {{-- <p><strong>Payments:</strong> $100.00</p> --}}
        </div>
    </div>
</body>
</html>
