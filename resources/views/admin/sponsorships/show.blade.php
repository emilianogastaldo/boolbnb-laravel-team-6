@extends('layouts.app')

@section('title', 'Selezione Appartamento')

@section('content')
<div class="sponsorships-container d-flex align-items-center justify-content-center flex-column gap-4  mt-5"> <!-- style provvisorio -->
    <div class="row align-items-center justify-content-center">
        <div class="col-4">
            {{-- Card sponsorizzazione --}}
            <div class="card text-center shadow-sm">
                
                    <h4 class="mt-3 text-{{$sponsorship->name}}">
                        {{ucfirst($sponsorship->name)}}
                        <i class="fa-solid fa-crown fa-sm"></i>
                    </h4>                    
                
                <div class="card-body">
                    <h5 class="card-title">Prezzo: €{{$sponsorship->price}}</h5>
                    <p class="card-text">
                        Il tuo appartamento apparirà in Homepage nella sezione “Appartamenti in Evidenza” per <span class="text-gold text-decoration-underline">{{$sponsorship->days == '1' ? 'un giorno' : "$sponsorship->days giorni" }}</span>*
                    </p>
                        {{-- <a href="{{route('admin.sponsorships.show', $sponsorship->name)}}" class="btn btn-gold shadow">Acquista <i class="fa-solid fa-crown"></i></a> --}}
                    
                </div>
            </div>
        </div> 
        <div class="col-7">
            {{-- I tuoi Appartamenti --}}
            <h2 class="text-center mb-4">I tuoi appartamenti</h2>
            {{-- Tabella --}}
            <div class="table-responsive">
                <table class="table align-middle m-0">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Appartamento</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Paga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($flats as $flat)
                        <tr class="text-center">
                            <td>{{$flat->title}}</td>            
                            <td>{{$flat->address}}</td>
                            <td>
                                <a href="{{ route('admin.payment.token', ['sponsorship_id' => $sponsorship->id, 'flat_id' => $flat->id]) }}"
                                    class="btn btn-gold shadow">
                                    Paga <i class="fa-solid fa-crown"></i>
                                </a>
                            </td>
                            {{-- <td>{{$flat->image}}</td> --}}
                        </tr>
                        
                        @empty
                        {{-- Se vuoto --}}
                        <tr>
                            <td colspan="4">
                                Non ci sono appartamenti
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Disclaimer --}}
        <div id="pippo" class="d-flex align-items-center justify-content-center mt-4">
            <p class="mb-0">Terminato il periodo di sponsorizzazione, l'appartamento tornerà ad essere
                visualizzato normalmente, senza alcuna particolarità *</p>
        </div>
    </div>
</div>
<a class="btn btn-secondary mt-3 mb-2" href="{{ route('admin.sponsorships.index') }}">
    <i class="fa-solid fa-arrow-left"></i> Torna alle sponsorizzazioni
</a>
@endsection