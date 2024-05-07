@extends('layouts.app')

@section('title', $flat->title)

@section('content')
<div class="container">
    <div class="row gap-5 mb-4">
        <div class="col col-12 col-lg-6">
            <div class="card text-center flex-shrink-0">
                <img src="{{$flat->printImage()}}" class="card-img-top" alt="{{$flat->title}}">
                <div class="card-body">
                  <h1 class="card-title">{{$flat->title}}</h1>
                  <p class="card-text">{{$flat->description}}</p>
                  {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                </div>
            </div>
        </div>
        <div class="col">
            <h4>{{$flat->address}}</h4>
            <h5>Numero stanze: {{$flat->bed}}</h5>
            <h5>Numero bagni: {{$flat->bathroom}}</h5>
            <h5>Metratura: {{$flat->sq_m}} m<sup>2</sup></h5>
            {{-- servizi --}}
            <h5>Servizi offerti:</h5>
            <ul class="list-unstyled">
                @forelse($flat->services as $service)
                <li class="">{{$service->name}}: <i class="{{$service->icon}}" style="color: {{$service->color}}"></i></li>   
                @empty
                <li>Nessun Servizio</li>
                @endforelse
            </ul>            
        </div>
    </div>
    {{-- Buttons --}}
    <div class="d-flex justify-content-between">
        <a href="{{route('admin.flats.index')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Torna indietro</a>
        <a href="{{route('admin.flats.edit', $flat->id)}}" class="btn btn-warning"><i class="fa-solid fa-pencil me-2"></i>Modifica</a>
    </div>
</div>
@endsection
