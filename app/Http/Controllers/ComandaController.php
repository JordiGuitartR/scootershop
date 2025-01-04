<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComandaController extends Controller
{

    public function addToCart($producteId)
{
    $userId = auth()->id(); // Assumeix que l'usuari està autenticat

    // Obtenir la comanda actual o crear-ne una de nova
    $comanda = \App\Models\Comanda::firstOrCreate(
        ['user_id' => $userId, 'estat' => 'pendent'],
        ['data_comanda' => now(), 'total' => 0]
    );

    // Verificar si el producte ja és al carretó
    $comandaProducte = \App\Models\ComandaProducte::where('comanda_id', $comanda->id)
        ->where('producte_id', $producteId)
        ->first();

    if ($comandaProducte) {
        // Incrementar la quantitat
        $comandaProducte->increment('quantitat');
        $comandaProducte->update(['preu_unitari' => $comandaProducte->preu_unitari]);
    } else {
        // Afegir un nou producte al carretó
        $producte = \App\Models\Producte::findOrFail($producteId);

        \App\Models\ComandaProducte::create([
            'comanda_id' => $comanda->id,
            'producte_id' => $producteId,
            'quantitat' => 1,
            'preu_unitari' => $producte->preu,
        ]);
    }

    // Recalcular el total de la comanda
    $this->updateComandaTotal($comanda);

    return redirect()->route('cart');
}

public function updateQuantity($id, $action)
{
    $userId = auth()->id(); // Assumeix que l'usuari està autenticat

    // Obtenir la comanda activa
    $comanda = \App\Models\Comanda::where('user_id', $userId)
        ->where('estat', 'pendent')
        ->firstOrFail();

    // Obtenir el producte del carretó
    $comandaProducte = \App\Models\ComandaProducte::where('comanda_id', $comanda->id)
        ->where('producte_id', $id)
        ->firstOrFail();

    // Augmentar o disminuir la quantitat
    if ($action === 'increment') {
        $comandaProducte->increment('quantitat');
    } elseif ($action === 'decrement' && $comandaProducte->quantitat > 1) {
        $comandaProducte->decrement('quantitat');
    } elseif ($action === 'decrement' && $comandaProducte->quantitat == 1) {
        // Si la quantitat arriba a 0, elimina el producte
        $comandaProducte->delete();
    }

    // Recalcular el total de la comanda
    $this->updateComandaTotal($comanda);

    return redirect()->route('cart');
}


public function cart()
{
    $userId = auth()->id(); // Assumeix que l'usuari està autenticat

    // Obtenir la comanda actual
    $comanda = \App\Models\Comanda::where('user_id', $userId)
        ->where('estat', 'pendent')
        ->first();

    if (!$comanda) {
        return view('cart', ['productes' => [], 'comanda' => null]);
    }

    // Obtenir els productes del carretó
    $productes = \App\Models\ComandaProducte::with('producte')
        ->where('comanda_id', $comanda->id)
        ->get();

    return view('cart', compact('productes', 'comanda'));
}

public function removeFromCart($producteId)
{
    $userId = auth()->id(); // Assumeix que l'usuari està autenticat

    $comanda = \App\Models\Comanda::where('user_id', $userId)
        ->where('estat', 'pendent')
        ->first();

    if ($comanda) {
        \App\Models\ComandaProducte::where('comanda_id', $comanda->id)
            ->where('producte_id', $producteId)
            ->delete();

        // Recalcular el total de la comanda
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
