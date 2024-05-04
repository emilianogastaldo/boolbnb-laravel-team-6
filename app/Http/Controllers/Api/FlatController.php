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
        $address = $request->query('address');
        $distance = $request->query('distance');
        $room = $request->query('room');
        $bed = $request->query('bed');
        $services = $request->query('services');

        // Chiamata per raccogliere le informazioni sull' appartamento inserito dall'utente
        $response = Http::withoutVerifying()->get('https://api.tomtom.com/search/2/geocode/' . urlencode($address) . '.json?key=MZLTSagj2eSVFwXRWk7KqzDDNLrEA6UF');

        if ($response->successful() && isset($response->json()['results']) && !empty($response->json()['results'])) {
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
                ->with('services');
            // Se ho dei filtri, filtro la ricerca
            if ($distance) $query->having('distance', '<', $distance)->orderBy('distance');
            if ($room) $query->whereRoom($room);
            if ($bed) $query->whereBed($bed);
            if ($services) $query->whereHas('services', function ($query) use ($services) {
                // Ricerca nella colonna id della tabella services i servizi che ho passato
                $query->where('services.id', $services);
            });

            $flats = $query->get();
            return response()->json(compact('flats', 'services'));
        } else {
            // Gestisci il caso in cui non ci sono risultati dalla geocodifica
            return response()->json(['error' => 'Nessun risultato trovato per l\'indirizzo specificato.']);
        }
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
