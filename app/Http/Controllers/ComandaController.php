<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComandaController extends Controller
{

    public function addToCart($producteId)
{
    $userId = auth()->id(); 

    
    $comanda = \App\Models\Comanda::firstOrCreate(
        ['user_id' => $userId, 'estat' => 'pendent'],
        ['data_comanda' => now(), 'total' => 0]
    );

   
    $comandaProducte = \App\Models\ComandaProducte::where('comanda_id', $comanda->id)
        ->where('producte_id', $producteId)
        ->first();

    if ($comandaProducte) {
       
        $comandaProducte->increment('quantitat');
        $comandaProducte->update(['preu_unitari' => $comandaProducte->preu_unitari]);
    } else {
        $producte = \App\Models\Producte::findOrFail($producteId);

        \App\Models\ComandaProducte::create([
            'comanda_id' => $comanda->id,
            'producte_id' => $producteId,
            'quantitat' => 1,
            'preu_unitari' => $producte->preu,
        ]);
    }

    $this->updateComandaTotal($comanda);

    return redirect()->route('cart');
}

public function updateQuantity($id, $action)
{
    $userId = auth()->id(); 

    
    $comanda = \App\Models\Comanda::where('user_id', $userId)
        ->where('estat', 'pendent')
        ->firstOrFail();

    
    $comandaProducte = \App\Models\ComandaProducte::where('comanda_id', $comanda->id)
        ->where('producte_id', $id)
        ->firstOrFail();

    
    if ($action === 'increment') {
        $comandaProducte->increment('quantitat');
    } elseif ($action === 'decrement' && $comandaProducte->quantitat > 1) {
        $comandaProducte->decrement('quantitat');
    } elseif ($action === 'decrement' && $comandaProducte->quantitat == 1) {
        
        $comandaProducte->delete();
    }

    
    $this->updateComandaTotal($comanda);

    return redirect()->route('cart');
}


public function cart()
{
    $userId = auth()->id(); 

    
    $comanda = \App\Models\Comanda::where('user_id', $userId)
        ->where('estat', 'pendent')
        ->first();

    if (!$comanda) {
        return view('cart', ['productes' => [], 'comanda' => null]);
    }

    $productes = \App\Models\ComandaProducte::with('producte')
        ->where('comanda_id', $comanda->id)
        ->get();

    return view('cart', compact('productes', 'comanda'));
}

public function removeFromCart($producteId)
{
    $userId = auth()->id();

    $comanda = \App\Models\Comanda::where('user_id', $userId)
        ->where('estat', 'pendent')
        ->first();

    if ($comanda) {
        \App\Models\ComandaProducte::where('comanda_id', $comanda->id)
            ->where('producte_id', $producteId)
            ->delete();

        
        $this->updateComandaTotal($comanda);
    }

    return redirect()->route('cart');
}

private function updateComandaTotal($comanda)
{
    $total = \App\Models\ComandaProducte::where('comanda_id', $comanda->id)
        ->sum(\DB::raw('quantitat * preu_unitari'));

    $comanda->update(['total' => $total]);
}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comanda $comanda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comanda $comanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comanda $comanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comanda $comanda)
    {
        //
    }
}
