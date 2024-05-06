@extends('layouts.app')

@section('title', 'Sponsorizzazioni')

@section('content')
<div class="sponsorships-container d-flex align-items-center justify-content-center flex-column gap-4 my-5">
    <div class="row">
        @foreach ($sponsorships as $sponsorship) 
        <div class="col-4 " >
            <div class="card text-center shadow-sm">
                <h4 class="mt-3 text-{{$sponsorship->name}}">
                    {{ucfirst($sponsorship->name)}}
                </h4>                    
                <div class="card-body">
                    <h5 class="card-title">Prezzo: €{{$sponsorship->price}}</h5>
                    <p class="card-text">
                        Il tuo appartamento apparirà in Homepage nella sezione “Appartamenti in Evidenza” per <span class="text-gold">{{$sponsorship->days == '1' ? 'un giorno' : "$sponsorship->days giorni" }}</span>*</p>
                        <a href="{{route('admin.sponsorships.show', $sponsorship->name)}}" class="btn btn-gold shadow">Acquista <i class="fa-solid fa-crown"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        
    <div id="pippo" class="d-flex align-items-center justify-content-center">
        <p class="mb-0"> Terminato il periodo di sponsorizzazione, l'appartamento tornerà ad essere
             visualizzato normalmente, senza alcuna particolarità *</p>
    </div>
</div>
<a href="{{route('admin.flats.index')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Torna indietro</a>
@endsection
