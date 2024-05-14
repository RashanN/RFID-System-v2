{{-- <x-app-layout> --}}
  {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot> --}}
  @extends('layouts.land')


  @section('content')
  <section>
  <link rel="stylesheet" href="{{asset('css/panel1.css')}}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('font/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/bootstrap.bundle.min.js') }}">
  <script src="{{ asset('js/nav.js') }}"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-abcdef..." crossorigin="anonymous" />
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
          
                  <body>
                    <div class="sidebar">
                    <header>My App</header>
                  <ul>
                {{-- <li><a href="#"><i class="fas fa-qrcode"></i>Dashboard</a></li> --}}
                <li><a href="{{ route('customer.index') }}"><i class="fas fa-user"></i></i>Customers</a></li>
                <li><a href="{{ route('child.index') }}"><i class="fas fa-child"></i>Child</a></li>
                <li><a href="{{ route('invoice.create') }}"><i class="fas fa-file-invoice"></i>Invoice</a></li>
                <li><a href="{{ route('invoice.draft') }}"><i class="fas fa-clock"></i>Pre Orders</a></li>
                <li><a href="#"><i class="fas fa-warehouse"></i>Check Stock</a></li>
                @if($usertype === 'admin')
                <li><a href="{{route('product_category.index')}}"><i class="fas fa-folder"></i>Category</a></li>
              
                 <li><a href="{{ route('product.index') }}"><i class="fas fa-tag"></i>Products</a></li>
              
                 {{-- <li><a href="{{ route('product.index') }}"><i class="fas fa-stream"></i>Products</a></li> --}}
                <li><a href="{{ route('supplier.index') }}"><i class="fas fa-truck"></i>Suppliers</a></li>
                <li><a href="{{ route('playtimeprices.index') }}"><i class="fas fa-ticket-alt"></i>PlayTime Price</a></li>
                <li><a href="{{ route('playtimeprices.index') }}"><i class="fas fa-file"></i></i>All Invoices</a></li>
                @endif
                
                
                </ul>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <div class="cardset">
                  <div class="container mt-4">
                    <div class="row">
                      <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Number of Customers</h5>
                            <p class="card-text">{{($customerCount)}}</p>
                            <a href="#" class="btn btn-primary">View Customers</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Number of Children</h5>
                            <p class="card-text">{{($childrenCount)}}</p>
                            <a href="#" class="btn btn-primary">View Children</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Daily Invoice Count</h5>
                            <p class="card-text">{{($invoiceCount)}}</p>
                            <a href="{{ route('invoice.index') }}" class="btn btn-primary">View Invoices</a>
                          </div>
                        </div>
                      </div>
                     
                      <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Income For This Month</h5>
                            <p class="card-text">{{($totalMonth)}}</p>
                            <a href="#" class="btn btn-primary">View Income Details</a>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Income For Today</h5>
                            <p class="card-text">{{($totalToday)}}</p>
                            <a href="#" class="btn btn-primary">View Income Details</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
                  @if($usertype === 'admin')
                <div class="container mt-4">
                  <!-- Your existing cardset -->
                  <div class="row">
                    <div class="col">
                      <canvas id="incomeChart" width="300px" height="150px"></canvas>
                    </div>
                    <div class="col" style="padding-left: 20px">
                      <div style="width:300px; height: 300px;">
                        <canvas id="genderChart"></canvas>
                    </div>
                    </div>
                    <div class="col">
                      <canvas id="barChart"  width="150px" height="150px"></canvas>
                    </div>
                </div>
                <div class="row">
                  
                </div>
                </div>
                @endif
              </div>
            </section>
          </body>
      </html>
      <script>
        // Get data for the chart
        var childrenCount = <?php echo json_encode($childrenCount); ?>;
        console.log('count',childrenCount);
        var totalMonth = <?php echo json_encode($totalMonth); ?>;
        console.log(totalMonth)
        // Chart.js configuration
        var labels = Array.isArray(childrenCount) ? childrenCount.map(String) : [];

    // Chart.js configuration
    var ctx = document.getElementById('incomeChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($dataSet['labels']); ?>,
        datasets: [{
            label: 'Total Sales',
            data: <?php echo json_encode($dataSet['data']); ?>,
            backgroundColor: colors,
            borderColor: colors,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Date'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Number Of Sales'
                }
            }
        }
    }
});

var childGenders = @json($childGenders);

// Extract labels (genders) and counts
var labels = childGenders.map(child => child.gender);
var counts = childGenders.map(child => child.count);

// Generate random colors for the pie chart
var colors = [];
for (var i = 0; i < labels.length; i++) {
    var randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
    colors.push(randomColor);
}

// Render pie chart
var ctx = document.getElementById('genderChart').getContext('2d');
var genderChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: counts,
            backgroundColor: colors
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Child Gender Distribution'
        }
    }
});

/////income bar chart

var barChartData = @json($barChartData);

// Render bar chart
var ctx = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: barChartData.labels,
        datasets: [{
            label: 'Invoice Count',
            data: barChartData.data,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
      




   
@endsection
  {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot> --}}

