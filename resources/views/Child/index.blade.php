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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Custom CSS -->
<style>
    /* Additional custom styles */
    .container {
        margin-top: 50px;

    }
</style>
    </head>
<div class="container">
    <div class="row">
        
        <div class="col-md-3">
            <h2>All Childern</h2>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for child.."/>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" id="parentInput" onkeyup="parentFunction()" placeholder="Search for parent.."/>
        </div>
        <div class="col-md-3 text-right">
            <a href="{{ route('child.create') }}" class="btn btn-success">Add New Child</a>
            <a href="#" class="btn btn-primary download"><i class="fas fa-download" onclick="downloadExcel()"></i></a>
        </div>
        
    </div>
        <table class="table" id="myTable">
            <thead>
                <tr>

                   
                    <th scope="col">Child Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">School</th>
                    <th scope="col">Parent Name</th>
                    <th scope="col">Relationship to Parent</th>
                    <th scope="col">Parent Email</th>
                    <th scope="col">Parent Contact</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($children as $child)
                    <tr>

                       
                        <td>{{ $child->name }}</td>
                        <td>{{ $child->DOB }}</td>
                        <td>{{ $child->school ?: 'N/A' }}</td>
                        <td>{{ $child->customer->name }}</td>
                        <td>{{$child->relationship}}</td>
                        <td>{{ $child->customer->email }}</td>
                        <td>{{ $child->customer->contact ?: 'N/A' }}</td>
                        <td>
                            <a href="{{ route('child.edit', $child->id) }}" class="btn btn-primary">Edit</a> <!-- Edit button -->
                            {{-- <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button> <!-- Delete button -->
                            </form> --}}
                            <form action="{{ route('child.destroy', $child->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        function myFunction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          console.log(filter);
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }

        function parentFunction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("parentInput");
          filter = input.value.toUpperCase();
          console.log(filter);
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }


        //////////////////////download excel sheet

        function downloadExcel() {
        var table = document.getElementById("myTable");
        var data = [];
        for (var i = 0; i < table.rows.length; i++) {
            var row = [];
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                row.push(table.rows[i].cells[j].innerText);
            }
            data.push(row);
        }
        var csv = data.map(row => row.join(',')).join('\n');
        var blob = new Blob([csv], { type: 'text/csv' });
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'table_data.csv';
        link.click();
    }
        </script>
</x-app-layout>
