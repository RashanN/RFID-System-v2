<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playtimesprice;

class PlaytimespriceController extends Controller
{
    //
  
        public function index()
    {

        $playtimePrices = Playtimesprice::all();
        return view('playtimeprices.index', compact('playtimePrices'));
    }
    public function create()
    {
        return view('playtimeprices.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);
          
        Playtimesprice::create($validatedData);

        return redirect()->route('playtimeprices.index')
            ->with('success', 'Playtime price created successfully');
    }
    public function edit( Playtimesprice $playtimeprice)
    {
       
        return view('playtimeprices.edit', compact('playtimeprice'));
    }

    public function update(Request $request, Playtimesprice $playtimeprice)
    {
        $playtimePrices = Playtimesprice::all();
       
        $request->validate([
             'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $playtimeprice->update($request->all());

        return redirect()->route('playtimeprices.index')
            ->with('success', 'Playtime price updated successfully');
    }
public function show($id)
{
    $playtimePrices = Playtimesprice::all();
    return view('playtimeprices.index', compact('playtimePrices'));
}
}
