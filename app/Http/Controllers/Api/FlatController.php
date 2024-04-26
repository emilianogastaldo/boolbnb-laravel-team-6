<?php

namespace App\Http\Controllers\Api;

use App\Models\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query per la pagina iniziale
        $flats = Flat::select('id', 'title', 'description', 'address', 'room', 'bed', 'bathroom', 'sq_m', 'image')->get();

        foreach ($flats as $flat) {
            if ($flat->image) $flat->image = url('storage/' . $flat->image);
        }

        return response()->json($flats);
    }

    public function filteredIndex(string $address)
    {
        return response()->json("ciao");
        $flats = Flat::select('id', 'title', 'description', 'address', 'room', 'bed', 'bathroom', 'sq_m', 'image')->where('address', 'LIKE', "%$address%")->get();
        // address={address}?&rooms={room}?&bathrooms={bathroom}?&services={services}
        return response()->json($flats);
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
    public function show(string $slug)
    {
        $flat = Flat::select('*')->whereSlug($slug)->first();

        if (!$flat) return response(null, 404);

        return response()->json($flat);
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
