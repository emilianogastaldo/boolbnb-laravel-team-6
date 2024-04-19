<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flats = Flat::all();
        return view('admin.flats.index', compact('flats'));
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
    public function show(Flat $flat)
    {
        return view('admin.flats.show', compact('flat'));
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
    public function destroy(Flat $flat)
    {
        $flat->delete();
        return to_route('admin.flats.index')->with('message', "$flat->title eliminato con successo");
    }

    // funzione per la soft delete
    public function trash(){
        $flats = Flat::onlyTrashed()->get();
        return view('admin.flats.trash', compact('flats'));
    }

    // Funzione la strong delete
    public function drop(Flat $flat){
        $flat->forceDelete();
        return to_route('admin.flats.index')->with('type', 'warning')->with('message', "$flat->title eliminato definitivamente");
    }

    // Funzione per il restore
    public function restore(Flat $flat){
        $flat->restore();
        return to_route('admin.flats.index')->with('type', 'info')->with('message', "L'appartamento $flat->title è stato ripristinato");
    }
}
