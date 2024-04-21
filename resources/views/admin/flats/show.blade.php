@extends('layouts.app')

@section('title', $flat->title)

@section('content')
<div class="container">
    <h1>{{$flat->title}}</h1>
    <p>{{$flat->description}}</p>
    <h2>{{$flat->address}}</h2>
    <h2>Numero stanze: {{$flat->bed}}</h2>
    <h2>Numero bagni: {{$flat->bathroom}}</h2>
    <h2>Metratura: {{$flat->sq_m}}</h2>
    <figure>
        {{-- Image --}}
        <img src="{{asset('storage/' . $flat->image)}}" alt="{{$flat->title}}" class="img-fluid">
    </figure>
    {{-- <h2>{{$flat->latitude}}</h2>
    <h2>{{$flat->longitude}}</h2> DA DECOMMENTARE QUANDO SARANNO IMPLEMNETATE --}}
    <div class="d-flex justify-content-between">
        {{-- Go Back Button --}}
        <a href="{{route('admin.flats.index')}}" class="btn btn-secondary">Torna Indietro</a>
        <a href="{{route('admin.flats.edit', $flat->id)}}" class="btn btn-secondary">MODIFICA</a>
    </div>
</div>   
@endsection