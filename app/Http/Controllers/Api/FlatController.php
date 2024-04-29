<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query per la pagina iniziale
        $flats = Flat::whereIsVisible(true)->select('id', 'title', 'slug', 'description', 'address', 'room', 'bed', 'bathroom', 'sq_m', 'image')->get();
        $services = Service::all();

        foreach ($flats as $flat) {
            if ($flat->image) $flat->image = url('storage/' . $flat->image);
        }

        if (request()->input('address')) {

            // Recupero l'address dalla query nella request
            $address = request()->query('address');
            // Chiamata per raccogliere le informazioni sull' appartamento inserito dall'utente
            $flatResponse = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/search/{$address}.json?key=MZLTSagj2eSVFwXRWk7KqzDDNLrEA6UF&countrySet=IT&municipality=Roma");
            $flat_infos = $flatResponse->json();

            // Riassegnamento latitude, longitute e via con le informazioni ottenute dalla chiamata
            $lat = $flat_infos['results'][0]['position']['lat'];
            $lon = $flat_infos['results'][0]['position']['lon'];
            $range = 20;

            // Creo una query per filtrare
            $flats = Flat::whereIsVisible(true)
                ->whereRaw("(6371 * acos(cos(radians(" . $lat . ")) * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $lon . ")) + sin(radians(" . $lat . ")) * sin(radians(latitude)))) <=" . $range)
                ->orderByRaw("(6371 * acos(cos(radians(" . $lat . ")) * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $lon . ")) + sin(radians(" . $lat . ")) * sin(radians(latitude)))) asc")
                ->with('services')
                ->get();
        }
        // Ritorno $flats e i servizi
        $response = [
            'flats' => $flats,
            'services' => $services
        ];
        return response()->json(compact('flats', 'services'));
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
        $flat = Flat::whereIsVisible(true)->whereSlug($slug)->with('services')->first();

        if (!$flat) return response(null, 404);
        if ($flat->image) $flat->image = url('storage/' . $flat->image);

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
