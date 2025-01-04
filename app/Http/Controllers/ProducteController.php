<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use App\Http\Controllers\Controller;
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
     * Show the form for editing the specified resource.
     */
    public function edit(Producte $producte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producte $producte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producte $producte)
    {
        //
    }
}
