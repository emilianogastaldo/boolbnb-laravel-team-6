<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;
use Illuminate\Support\Arr;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // recupero il termine della ricerca dalla request
        $search = $request->query('search');
        // aggiungo il termine alla query
        $flats = Flat::where('title', 'LIKE', "%$search%")->get();
        return view('admin.flats.index', compact('flats', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flat = new Flat();
        return view('admin.flats.create', compact('flat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string',
                'room' => 'required|min:1|numeric',
                'bed' => 'required|min:1|numeric',
                'bathroom' => 'required|min:1|numeric',
                'sq_m' => 'required|min:0|numeric',
            ],
            [
                'title.required' => 'Devi inserire un nome alla casa',
                'room.required' => 'Devi inserire almeno una stanza',
                'room.min' => 'Devi inserire almeno una stanza',
                'room.numeric' => 'Il valore inserito deve essere un numero',
                'bed.required' => 'Devi inserire almeno un posto letto',
                'bed.min' => 'Devi inserire almeno un posto letto',
                'bed.numeric' => 'Il valore inserito deve essere un numero',
                'bathroom.required' => 'Devi inserire almeno un bagno',
                'bathroom.min' => 'Devi inserire almeno un bagno',
                'bathroom.numeric' => 'Il valore inserito deve essere un numero',
                'sq_m.required' => 'Devi inserire la metratura dell\'appartamento',
                'sq_m.min' => 'Devo essere maggiore di 0',
                'sq_m.numeric' => 'Il valore inserito deve essere un numero',
            ]
        );
        $data = $request->all();
        // dd($data);

        $new_flat = new Flat();
        $new_flat->fill($data);
        $new_flat->is_visible = Arr::exists($data, 'is_visible');
        $new_flat['latitude'] = 0;
        $new_flat['longitude'] = 0;
        $new_flat->save();

        return to_route('admin.flats.index')->with('message', 'Pogretto creato con successo')->with('type', 'success');
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
    public function edit(Flat $flat)
    {
        return view('admin.flats.edit', compact('flat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flat $flat)
    {
        $data = $request->validate(
            [
                'title' => 'required|string',
                'room' => 'required|min:1|max:255|numeric',
                'bed' => 'required|min:1|max:255|numeric',
                'bathroom' => 'required|min:1|max:255|numeric',
                'sq_m' => 'required|min:0|max:65535|numeric',
            ],
            [
                'title.required' => 'Devi inserire un nome alla casa',
                'room.required' => 'Devi inserire almeno una stanza',
                'room.min' => 'Devi inserire almeno una stanza',
                'room.max' => 'Puoi inserire massimo 255',
                'room.numeric' => 'Il valore inserito deve essere un numero',
                'bed.required' => 'Devi inserire almeno un posto letto',
                'bed.min' => 'Devi inserire almeno un posto letto',
                'bed.max' => 'Puoi inserire massimo 255',
                'bed.numeric' => 'Il valore inserito deve essere un numero',
                'bathroom.required' => 'Devi inserire almeno un bagno',
                'bathroom.min' => 'Devi inserire almeno un bagno',
                'bathroom.max' => 'Puoi inserire massimo 255',
                'bathroom.numeric' => 'Il valore inserito deve essere un numero',
                'sq_m.required' => 'Devi inserire la metratura dell\'appartamento',
                'sq_m.min' => 'Devo essere maggiore di 0',
                'sq_m.numeric' => 'Il valore inserito deve essere un numero',
                'sq_m.max' => 'Puoi inserire massimo 65535',
            ]
        );

        $flat->update($data);
        return to_route('admin.flats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flat $flat)
    {
        $flat->delete();
        return to_route('admin.flats.index')->with('message', "$flat->title eliminato con successo")->with('type', 'danger');
    }


    /**
     * Funzione per implementare la soft delete
     */
    public function trash()
    {
        $flats = Flat::onlyTrashed()->get();
        return view('admin.flats.trash', compact('flats'));
    }

    /**
     * Funzione per implementare la strong delete
     */
    public function drop(Flat $flat)
    {
        $flat->forceDelete();
        return to_route('admin.flats.index')->with('type', 'warning')->with('message', "$flat->title eliminato definitivamente");
    }

    /**
     * Funzione per implementare il restore del flat trashed
     */
    public function restore(Flat $flat)
    {
        $flat->restore();
        return to_route('admin.flats.index')->with('type', 'info')->with('message', "L'appartamento $flat->title è stato ripristinato");
    }
}
