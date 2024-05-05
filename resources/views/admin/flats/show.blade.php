@extends('layouts.app')

@section('title', $flat->title)

@section('content')
<div class="container">
    <div class="d-flex gap-5 mb-4">
        <div class="card text-center flex-shrink-0" style="width: 50%;">
            <img src="{{$flat->printImage()}}" class="card-img-top" alt="{{$flat->title}}">
            <div class="card-body">
              <h1 class="card-title">{{$flat->title}}</h1>
              <p class="card-text">{{$flat->description}}</p>
              {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
        <div>
            <h4>{{$flat->address}}</h4>
            <h5>Numero stanze: {{$flat->bed}}</h5>
            <h5>Numero bagni: {{$flat->bathroom}}</h5>
            <h5>Metratura: {{$flat->sq_m}}</h5>
            {{-- servizi --}}
            <h5>Servizi offerti:</h5>
            @forelse($flat->services as $service)
            <span class="">{{ $service->name }}:</span>
            <i class="{{$service->icon}} me-2 ms-1" style="color: {{$service->color}}"></i>
            @empty
            <h5>Nessun Servizio</h5>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-between">
        {{-- Go Back Button --}}
        <a href="{{route('admin.flats.index')}}" class="btn index">Torna alla Home</a>
        <a href="{{route('admin.flats.edit', $flat->id)}}" class="btn edit">Modifica</a>
    </div>
</div>   

@endsection
