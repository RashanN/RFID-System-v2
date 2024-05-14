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
  
</head>
<body>
  <link rel="stylesheet" href="{{asset('css/panel.css')}}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-abcdef..." crossorigin="anonymous" />
  
  <aside>
    <p> Menu </p>
    <a href="{{ route('customer.index') }}">
      <i class="fas fa-tasks" aria-hidden="true"></i>
      Customers
    </a>
    <a href="javascript:void(0)">
      <i class="fa fa-laptop" aria-hidden="true"></i>
      Dashboard
    </a>
    <a href="{{ route('child.index') }}">
      <i class="fa fa-clone" aria-hidden="true"></i>
      Child
    </a>
    <a href="{{ route('invoice.create') }}">
      <i class="fas fa-plus-square" aria-hidden="true"></i>
      Invoice
    </a>
    <a href="">
      <i class="fas fa-user-plus" aria-hidden="true"></i>
      Check Stock
    </a>
    
  </aside>

  <div class="social">
    <a href="https://www.linkedin.com/in/florin-cornea-b5118057/" target="_blank">
      <i class="fa fa-linkedin"></i>
    </a>
  </div>




</body>
</html>

</x-app-layout>
