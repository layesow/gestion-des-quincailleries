<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quincaillerie;
use Illuminate\Http\Request;

class QuincallerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quincailleries = Quincaillerie::orderBy('id', 'desc')->get();
        $statut = ['actif', 'inactif'];

        return view('admin.quincailleries.index', compact('quincailleries','statut'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quincailleries.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // name et staut
        $request->validate([
            'name' => 'required',
            'statut' => 'required',
            ]);

        $quincaillerie = new Quincaillerie();
        $quincaillerie->name = $request->input('name');
        $quincaillerie->statut = $request->input('statut');
        $quincaillerie->save();
        return redirect()->route('admin.quincaillerie')->with('success', 'Quincaillerie ajouté avec succès');
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
        $quincaillerie = Quincaillerie::find($id);
        return view('admin.quincailleries.edit', compact('quincaillerie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $quincaillerie = Quincaillerie::find($id);
        $quincaillerie->name = $request->input('name');
        $quincaillerie->statut = $request->input('statut');
        $quincaillerie->save();
        return redirect()->route('admin.quincaillerie')->with('success', 'Quincaller mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quincaillerie = Quincaillerie::find($id);
        $quincaillerie->delete();
        return redirect()->route('admin.quincaillerie')->with('success', 'Quincaller supprimé avec succès.');

    }
}
