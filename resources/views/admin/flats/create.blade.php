@extends('layouts.app')

@section('title', 'Nuovo Appartamento')

@section('content')
<h1>Prova</h1> 
<span>I campi con <span class="text-danger">*</span> sono obbligatori </span>
<form action="{{route('admin.flats.store')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row g-4">
        {{-- Input per il titolo della casa --}}
        <div class="col-6 mb-3">
            <label for="title" class="form-label">Titolo <span class="text-danger"> * </span></label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Dai un nome all'appartamento">    
        </div>
        {{-- Input per la via della casa --}}
        <div class="col-6 mb-3">
            <label for="address" class="form-label">Indirizzo <span class="text-danger"> * </span></label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Scrivi la via dell'appartamento">
        </div>

        {{-- Numero di: stanze, letti, bagni, metratura, --}}
        <div class="col-3 mb-3">
            <label for="room" class="form-label">Numero di stanze <span class="text-danger"> * </span>
                <input type="number" class="form-control" id="room" name="room" placeholder="Inserisci numero stanze">
            </label>
        </div>
        <div class="col-3 mb-3">
            <label for="bed" class="form-label">Numero di letti <span class="text-danger"> * </span>
                <input type="number" class="form-control" id="bed" name="bed" placeholder="Inserisci posti letto">
            </label>
        </div>
        <div class="col-3 mb-3">
            <label for="bathroom" class="form-label">Numero di bagni <span class="text-danger"> * </span>
                <input type="number" class="form-control" id="bathroom" name="bathroom" placeholder="Inserisci numero bagni">
            </label>
        </div>
        <div class="col-3 mb-3">
            <label for="sq-m" class="form-label">Metratura <span class="text-danger"> * </span>
                <input type="number" class="form-control" id="sq-m" name="sq_m" placeholder="Inserisci metratura">
            </label>
        </div>
        
        {{-- Aggiunta immagine --}}
        <div class="col-12 mb-3">
            <label for="image" class="form-label">Immagine <span class="text-danger"> * </span></label>
            <input type="text" class="form-control" id="image" name="image" placeholder="Aggiungi url immagine">    
        </div>

        {{-- Descrizione dell'appartamento --}}
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control" placeholder="" id="description" name="description" style="height: 150px"></textarea>
                <label for="description" class="ms-2">Scrivi una descrizione dell'appartamento <span class="text-danger"> * </span></label>
            </div>        
        </div>

        {{-- Bozza o pubblico --}}
        <div class="col">
            <div class="form-check form-switch form-check-reverse">
                <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible">
                <label class="form-check-label" for="is_visible">Pubblicato</label>
            </div>
        </div>
    </div>
    <button class="btn btn-success">Aggiungi</button>
</form>

@endsection