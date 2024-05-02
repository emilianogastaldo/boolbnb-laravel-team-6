@extends('layouts.app')

@section('title', 'Sponsorizzazioni')

@section('content')
<div class="sponsorships-container d-flex align-items-center justify-content-center flex-column gap-4" style="height: 80vh"> <!-- style provvisorio -->
    <div class="row">
        @foreach ($sponsorships as $sponsorship) 
        <div class="col-4">
            <div class="card text-center">
                <div class="card-header">
                    {{ucfirst($sponsorship->name)}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Prezzo: €{{$sponsorship->price}}</h5>
                    <p class="card-text">
                        Il tuo appartamento apparirà in Homepage nella sezione “Appartamenti in Evidenza” per <span class="text-success">{{$sponsorship->duration}} ore</span>.</p>
                        <a href="{{route('admin.sponsorships.show', $sponsorship->name)}}" class="btn btn-primary">Acquista</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        
    <div id="pippo" class="d-flex align-items-center justify-content-center">
        <p class="mb-0">Terminato il periodo di sponsorizzazione, l'appartamento tornerà ad essere
             visualizzato normalmente, senza alcuna particolarità *</p>
    </div>
</div>
@endsection
