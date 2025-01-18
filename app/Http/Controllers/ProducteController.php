<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    public function home()
    {
        $productes = Producte::take(10)->get();
        return view('home', compact('productes'));
    }

    public function show($id)
    {
        $producte = Producte::with('categoria')->find($id);

        if (!$producte) {
            return view('producte', ['producte' => null]);
        }

        return view('producte', compact('producte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos del producto
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string|max:1000',
            'preu' => 'required|numeric',
        ]);

        // Buscar el producto por ID
        $producte = Producte::findOrFail($id);

        // Actualizar los datos del producto
        $producte->update([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'preu' => $request->preu,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('producte.show', $producte->id)
                         ->with('success', 'Producte actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producte $producte)
    {
        //
    }
}

