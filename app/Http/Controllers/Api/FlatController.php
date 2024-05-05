<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // query per la pagina iniziale
        $flats = Flat::whereIsVisible(true)->select('id', 'title', 'slug', 'description', 'address', 'room', 'bed', 'bathroom', 'sq_m', 'image')->with('services')->get();

        // Recupero i servizi
        $services = Service::all();

        foreach ($flats as $flat) {
            if ($flat->image) $flat->image = url('storage/' . $flat->image);
        }

        // Recupero gli input
        $addressInput = $request->query('address');
        $distanceInput = $request->query('distance');
        $roomInput = $request->query('room');
        $bedInput = $request->query('bed');
        $servicesInput = $request->query('services');

        // Chiamata per raccogliere le informazioni sull' appartamento inserito dall'utente

        if ($addressInput) {
            $response = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/' . urlencode($addressInput) . '.json?key=MZLTSagj2eSVFwXRWk7KqzDDNLrEA6UF');
            $coordinates = $response->json()['results'][0]['position'];

            $latitude = $coordinates['lat'];
            $longitude = $coordinates['lon'];

            $query = Flat::select(
                'id',
                'user_id',
                'title',
                'slug',
                'address',
                'description',
                'room',
                'bed',
                'bathroom',
                'sq_m',
                'image',
                'latitude',
                'longitude',
                DB::raw("(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance")
            )
                ->whereNull('deleted_at')
                ->whereIsVisible(true)
                ->with('user')
                ->with('services')
                ->orderBy('distance');
            // Se ho dei filtri, filtro la ricerca
            if ($distanceInput) $query->having('distance', '<', $distanceInput);
            if ($roomInput) $query->whereRoom($roomInput);
            if ($bedInput) $query->whereBed($bedInput);
            if ($servicesInput) $query->whereHas('services', function ($query) use ($servicesInput) {
                // Ricerca nella colonna id della tabella services i servizi che ho passato
                $query->where('services.id', $servicesInput);
            });

            $flats = $query->get();
            return response()->json(compact('flats', 'services'));
        }
        // else {
        //     // Gestisci il caso in cui non ci sono risultati dalla geocodifica
        //     return response()->json(['error' => 'Nessun risultato trovato per l\'indirizzo specificato.']);
        // }
        return response()->json(compact('flats', 'services'));
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
}
