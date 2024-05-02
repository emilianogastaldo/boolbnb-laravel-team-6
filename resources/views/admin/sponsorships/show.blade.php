@extends('layouts.app')

@section('title', 'Selezione Appartamento')

@section('content')
<div class="sponsorships-container d-flex align-items-center justify-content-center flex-column gap-4" style="height: 80vh"> <!-- style provvisorio -->
    <div class="row">
        <div class="col-4">
            {{-- Card sponsorizzazione --}}
            <div class="card text-center">
                <div class="card-header">
                    {{ucfirst($sponsorship->name)}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Prezzo: €{{$sponsorship->price}}</h5>
                    <p class="card-text">
                        Il tuo appartamento apparirà in Homepage nella sezione “Appartamenti in Evidenza” per <span class="text-success">{{$sponsorship->duration}} ore</span>.
                    </p>
                    <a href="#" class="btn btn-primary">Acquista</a>
                </div>
            </div>
        </div> 
        <div class="col-8">
            {{-- I tuoi Appartamenti --}}
            <h2 class="">I tuoi appartamenti</h2>
            {{-- Tabella --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Appartamento</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Paga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($flats as $flat)
                    <tr>
                        <td>{{$flat->title}}</td>            
                        <td>{{$flat->address}}</td>
                        <td>
                            <form action="{{route('admin.sponsorships.payment')}}" method="POST">
                            @csrf
                            <input type="text" class="d-none" value="{{$flat->id}}" name="flat_id" id="flat_id">
                            <input type="text" class="d-none" value="{{$sponsorship->id}}" name="sponsorship_id" id="sponsorship_id">
                                <button class="btn btn-primary">Paga</button>
                            </form>
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
        {{-- Disclaimer --}}
        <div id="pippo" class="d-flex align-items-center justify-content-center mt-4">
            <p class="mb-0">Terminato il periodo di sponsorizzazione, l'appartamento tornerà ad essere
                visualizzato normalmente, senza alcuna particolarità *</p>
        </div>
    </div>
</div>
@endsection