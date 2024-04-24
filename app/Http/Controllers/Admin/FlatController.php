<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flat;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // recupero il termine della ricerca dalla request
        $search = $request->query('search');
        // Recupero l'utente attivo
        $user_id = auth()->user()->id;

        // Creo la query
        $query = Flat::where('title', 'LIKE', "%$search%")->whereUserId($user_id);

        $flats = $query->get();
        return view('admin.flats.index', compact('flats', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flat = new Flat();
        $services = Service::all();
        return view('admin.flats.create', compact('flat', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'address' => 'required|string',
                'room' => 'required|min:1|numeric',
                'image' => 'nullable|image|mimes:png,jpg',
                'bed' => 'required|min:1|numeric',
                'bathroom' => 'required|min:1|numeric',
                'sq_m' => 'required|min:0|numeric',
                'is_visible' => 'nullable|boolean',
                'services' => 'nullable|exists:services,id',
            ],
            [
                'title.required' => 'Devi inserire un nome all\'appartamento',
                'description.required' => 'Devi inserire una descrizione all\'appartamento',
                'room.required' => 'Devi inserire almeno una stanza',
                'room.min' => 'Devi inserire almeno una stanza',
                'room.numeric' => 'Il valore inserito deve essere un numero',
                'address.required' => 'Devi inserire un indirizzo',
                'image.image' => 'Il file inserito non è un immagine',
                'image.mimes' => 'Si supportano solo le immagini con estensione .png o .jpg',
                'bed.required' => 'Devi inserire almeno un posto letto',
                'bed.min' => 'Devi inserire almeno un posto letto',
                'bed.numeric' => 'Il valore inserito deve essere un numero',
                'bathroom.required' => 'Devi inserire almeno un bagno',
                'bathroom.min' => 'Devi inserire almeno un bagno',
                'bathroom.numeric' => 'Il valore inserito deve essere un numero',
                'sq_m.required' => 'Devi inserire la metratura dell\'appartamento',
                'sq_m.min' => 'Devo essere maggiore di 0',
                'sq_m.numeric' => 'Il valore inserito deve essere un numero',
                'services.exists' => 'I tag selezionati non sono validi'
            ]
        );
        // Recupro i dati dopo averli validati
        $data = $request->all();

        // Creo il nuovo appartamento che andrò a riempire
        $new_flat = new Flat();

        // Chiamata per raccogliere le informazioni sull' appartamento inserito dall'utente
        $response = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/{$data['address']}.json?storeResult=false&countrySet=IT&view=Unified&key=7HTi0jsdt2LOACuuEHuHjOPmcdLsmvEw"); //! QUERY DI PROVA 
        $flat_infos = $response->json();

        // Riassegnamento latitude, longitute e via con le informazioni ottenute dalla chiamata
        $data['latitude'] = $flat_infos['results'][0]['position']['lat'];
        $data['longitude'] = $flat_infos['results'][0]['position']['lon'];
        $data['address'] = $flat_infos['results'][0]['address']['freeformAddress'];

        // Non faccio controlli poiché l'immagine è obbligatoria, quindi avrò per forza il dato dell'immagine
        $data['image'] = Storage::putFile('flat_images', $data['image']);

        // Do il valore booleano alla visibilità
        $data['is_visible'] = Arr::exists($data, 'is_visible');

        // Inserico come autore l'utente attualmente loggato
        $new_flat->user_id = Auth::id();

        $new_flat->fill($data);
        $new_flat->save();

        // creo la realzione tra progetto e tecnologia
        if (Arr::exists($data, 'services')) $new_flat->services()->attach($data['services']);

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
        // Recupero l'utente attivo
        $user_id = auth()->user()->id;
        if ($user_id !== $flat->user->id) return to_route('admin.flats.index');
        $prev_services = $flat->services->pluck('id')->toArray();
        $services = Service::all();
        return view('admin.flats.edit', compact('flat', 'services', 'prev_services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flat $flat)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'address' => 'required|string',
                'room' => 'required|min:1|numeric',
                'image' => 'nullable|image|mimes:png,jpg',
                'bed' => 'required|min:1|numeric',
                'bathroom' => 'required|min:1|numeric',
                'sq_m' => 'required|min:0|numeric',
                'is_visible' => 'nullable|boolean',
                'services' => 'nullable|exists:services,id',
            ],
            [
                'title.required' => 'Devi inserire un nome all\'appartamento',
                'description.required' => 'Devi inserire una descrizione all\'appartamento',
                'room.required' => 'Devi inserire almeno una stanza',
                'room.min' => 'Devi inserire almeno una stanza',
                'room.numeric' => 'Il valore inserito deve essere un numero',
                'address.required' => 'Devi inserire un indirizzo',
                'image.image' => 'Il file inserito non è un immagine',
                'image.mimes' => 'Si supportano solo le immagini con estensione .png o .jpg',
                'bed.required' => 'Devi inserire almeno un posto letto',
                'bed.min' => 'Devi inserire almeno un posto letto',
                'bed.numeric' => 'Il valore inserito deve essere un numero',
                'bathroom.required' => 'Devi inserire almeno un bagno',
                'bathroom.min' => 'Devi inserire almeno un bagno',
                'bathroom.numeric' => 'Il valore inserito deve essere un numero',
                'sq_m.required' => 'Devi inserire la metratura dell\'appartamento',
                'sq_m.min' => 'Devo essere maggiore di 0',
                'sq_m.numeric' => 'Il valore inserito deve essere un numero',
                'services.exists' => 'I tag selezionati non sono validi'
            ]
        );
        $data = $request->all();

        // Cancello e metto la nuova immagine
        if (Arr::exists($data, 'image')) {
            Storage::delete($flat->image);
            $data['image'] = Storage::putFile('flat_images', $data['image']);
        }

        // Riassegno l'essere visibile o meno
        $data['is_visible'] = Arr::exists($data, 'is_visible');

        // Chiamata per raccogliere le informazioni sull' appartamento inserito dall'utente
        $response = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/{$data['address']}.json?storeResult=false&countrySet=IT&view=Unified&key=7HTi0jsdt2LOACuuEHuHjOPmcdLsmvEw"); //! QUERY DI PROVA 
        $flat_infos = $response->json();

        // Riassegnamento dei campi latitude e longitute con le informazioni ottenute dalla chiamata
        $data['latitude'] = $flat_infos['results'][0]['position']['lat'];
        $data['longitude'] = $flat_infos['results'][0]['position']['lon'];
        $data['address'] = $flat_infos['results'][0]['address']['freeformAddress'];

        $flat->update($data);

        // Aggiorno il legame tra progetti e tecnologie
        if (Arr::exists($data, 'services')) $flat->services()->sync($data['services']);
        elseif (!Arr::exists($data, 'services') && $flat->has('services')) $flat->services()->detach();
        return to_route('admin.flats.show', compact('flat'));
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
    // public function drop(Flat $flat)
    // {
    //     $flat->forceDelete();
    //     return to_route('admin.flats.index')->with('type', 'warning')->with('message', "$flat->title eliminato definitivamente");
    // }

    /**
     * Funzione per implementare il restore del flat trashed
     */
    public function restore(Flat $flat)
    {
        // Cancello l'immagine dallo Storage
        if ($flat->image) Storage::delete($flat->image);
        $flat->restore();
        return to_route('admin.flats.index')->with('type', 'info')->with('message', "L'appartamento $flat->title è stato ripristinato");
    }
}
