
<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
	@include('layouts.navigation')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Create Product</title>
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Playtime Prices</div>
                <div class="card-body">
                    <p style="font-size: 14px">A -> Price for Kids 1 timeslot</p>
                    <p style="font-size: 14px">B -> Price for Kids 2 timeslot</p>
                    {{-- <a href="{{ route('playtimeprices.create') }}" class="btn btn-primary mb-3">Create New Playtime Price</a> --}}
                        {{-- {{dd($playtimePrices )}}$playtimePrices->isEmpty() --}}
                    @if ($playtimePrices->isEmpty())
                        <p>No playtime prices found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($playtimePrices as $playtimePrice)
                                    <tr>
                                        <td>{{ $playtimePrice->id }}</td>
                                        <td>{{ $playtimePrice->name }}</td>
                                        <td>{{ $playtimePrice->price }}</td>
                                        <td>
                                            <a href="{{ route('playtimeprices.edit', $playtimePrice->id) }}" class="btn btn-primary">Edit</a>
                                            <!-- Add delete button and form here -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
