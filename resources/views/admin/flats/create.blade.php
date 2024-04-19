@extends('layouts.app')

@section('title', 'Nuovo Appartamento')

@section('content')
<h1>prova</h1>
<form action="{{route('admin.flats.store')}}">
@csrf
<div class="row">
    {{-- Input per il titolo della casa --}}
    <div class="col-6 mb-3">
        <label for="title" class="form-label">Titolo *</label>
        <input type="text" class="form-control" id="title" placeholder="Dai un nome all'appartamento">
        <div class="form-text">Dai un nome all'appartamento</div>
    </div>
    {{-- Input per la via della casa --}}
    <div class="col-6 mb-3">
        <label for="address" class="form-label">Indirizzo *</label>
        <input type="text" class="form-control" id="address" placeholder="Scrivi la via dell'appartamento">
    </div>
    {{-- Numero di: stanze, letti, bagni, metratura, --}}
    <div class="col mb-3">
        <label for="room" class="form-label">Numero di stanze *
            <input type="number" class="form-control" id="room" placeholder="Scrivi la via dell'appartamento">
        </label>
    </div>
    <div class="col mb-3">
        <label for="bed" class="form-label">Numero di letti *
            <input type="number" class="form-control" id="bed" placeholder="Scrivi la via dell'appartamento">
        </label>
    </div>
    <div class="col mb-3">
        <label for="bathroom" class="form-label">Numero di bagni *
            <input type="number" class="form-control" id="bathroom" placeholder="Scrivi la via dell'appartamento">
        </label>
    </div>
    <div class="col mb-3">
        <label for="sq-m" class="form-label">Metratura *
            <input type="number" class="form-control" id="sq-m" placeholder="Scrivi la via dell'appartamento">
        </label>
    </div>
    
</div>
</form>

@endsection