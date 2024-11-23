<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer les stocks pour la quincaillerie de l'utilisateur
        /* $user = Auth::user();
        $stocks = Stock::where('quincaillerie_id', $user->quincaillerie_id)->get();
        return view('admin.stocks.index', compact('stocks')); */

        // Récupérer les stocks pour la quincaillerie de l'utilisateur avec les produits associés
        $user = Auth::user();
        $stocks = Stock::where('quincaillerie_id', $user->quincaillerie_id)
                        ->with('produit') // Charger les produits associés
                        ->get();

        return view('admin.stocks.index', compact('stocks'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
