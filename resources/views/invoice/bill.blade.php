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
                max-height: 100px;
                size: portrait;
            }
            .container {
                width: 80mm; /* Set the width for the printer */
                margin: 0 auto;
                max-height: 100px;
            }
            .header {
                margin-bottom: 10px;
                max-height: 100px;
            }
            .table th, .table td {
                padding: 4px;
                font-size: 10px; /* Adjust font size for table cells */
            }
            .total-section {
                margin-top: 10px;
                max-height: 100px;
            }
            .no-print {
                display: none; /* Hide elements not necessary for print */
            }
         
        }
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            max-height: 100px;
        }
        .container {
            max-width: 800px; /* Set the maximum width for regular view */
            margin: 0 auto;
            min-height: 300px;
            max-height: 0 auto;
            max-height: 100px;
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
        <button class= " no-print"onclick="window.location.href='admin/dashboard'">Back to Dashboard</button>
      <button class="no-print" onclick="window.print()">Print</button>
        <div class="header">
            <img src="/image/bgicon.jpg" alt="Company Logo">
            <h2 style="font-size:12px">House Of Play</h2>
            <p style="font-size:10px">Lake Road,Boaralesgamuwa</p>
            <p style="font-size:10px">Company Telephone</p>
            <p style="font-size:10px"><strong></strong> "Thank you for choosing us."</p>
        </div>
        <div class="invoice-details">
            <p style="font-size:12px"><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
            <p style="font-size:12px"><strong>Customer Name:</strong> {{$customerName}}</p>
        </div>

        <div class="playtime-order">
            <h3 style="font-size:12px">Playtime </h3>
            <table class="table">
                <thead>
                    <tr style="font-size:12px">
                        <th>Name</th>
                        <th>In Time</th>
                        <th>Out Time</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($playtimeOrders as $playtimeOrder)
                    <tr style="font-size:12px">
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
            <h3 style="font-size:12px">Other Product</h3>
            <table class="table">
                <thead>
                    <tr style="font-size:12px">
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseItems as $purchaseItem)
                    <tr style="font-size:12px">
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
            <p style="font-size:12px">Discount: Rs{{ $invoice->discount }}</p>
            <p style="font-size:12px">Fine (if applicable):Rs {{ $invoice->fine}}</p>
            <p style="font-size:12px"><strong>Grand Total :</strong> Rs {{ $invoice->total }}</p>

            {{-- <p><strong>Payments:</strong> $100.00</p> --}}
        </div>
    </div>
</body>
</html>
