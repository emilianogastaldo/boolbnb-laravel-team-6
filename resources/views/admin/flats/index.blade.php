@extends('layouts.app')

@section('title', 'Lista appartamenti')

@section('content')

<div class="container">
  <div class="d-flex align-items-center justify-content-between my-4">
    <form action="{{ route('admin.flats.index') }}" method="GET">
      <div class="input-group">
        <input type="search" name="search" class="form-control" placeholder="Cerca appartamento" value="{{ $search }}" autofocus>
        <button type="submit" class="input-group-text" id="basic-addon2"><i class="fas fa-magnifying-glass"></i></button>
      </div>
    </form>
    <div class="d-flex gap-3">
      {{-- Go to trash page button --}}
      <a href="{{route('admin.flats.trash')}}" class="btn btn-dark">
        <i class="fas fa-trash-can"></i> Vedi cestino
      </a>
      {{-- Add flat Button --}}
      <a href="{{route('admin.flats.create')}}" class="btn btn-success">
        <i class="fas fa-plus me-2"></i> Aggiungi appartamento
      </a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table align-middle m-0">
      <thead>
          <tr class="text-center">
              <th scope="col">Foto</th>
              <th scope="col">Appartamento</th>
              <th scope="col">Indirizzo</th>
              <th scope="col">Pubblico</th>
              <th scope="col">Stanze</th>
              <th scope="col">Letti</th>
              <th scope="col">Bagni</th>
              <th scope="col">Metratura</th>
              <th scope="col">Azioni</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($flats as $flat)
          <tr class="text-center">
              <td>
                <img class="img-fluid rounded-3" src="{{$flat->printImage()}}" alt="{{$flat->title}}" style="width: 200px">
              </td>            
              <td >
                <div class="d-flex flex-column">
                  <div>
                    @if ($flat->sponsored)
                    <span class="gold"><i class="fa-solid fa-crown"></i></span>
                    @endif              
                    {{$flat->title}}
                  </div>
                  <div>
                    <a class="btn btn-sm btn-primary mt-2">Sponsorizza</a>
                  </div>
                </div>
              </td>            
              <td>{{$flat->address}}</td>
              <td>{{$flat->is_visible ? 'Pubblico' : 'Privato'}}</td>
              <td>{{$flat->room}}</td>
              <td>{{$flat->bed}}</td>
              <td>{{$flat->bathroom}}</td>
              <td>{{$flat->sq_m}} m<sup>2</sup></td>
              <td>
                <div class="d-flex gap-2 flex-column align-items-center ">
                  <a href="{{route('admin.flats.show', $flat->id)}}" class="btn btn-sm btn-primary width-92">
                    {{-- <i class="fas fa-eye"></i> --}} VISUALIZZA
                  </a>
                  <a href="{{route('admin.messages.flat', $flat)}}" class="btn btn-sm orange width-92" href="">MESSAGGI</a>
                  <a href="{{route('admin.flats.edit', $flat->id)}}" class="btn btn-sm btn-warning width-92">
                    {{-- <i class="fas fa-pencil"></i> --}} MODIFICA
                  </a>
                  <form action="{{route('admin.flats.destroy', $flat->id)}}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal">                           
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger width-92" type="submit">
                      {{-- <i class="fas fa-trash-can"></i> --}} ELIMINA
                    </button>
                  </form>
                </div>
              </td>
          </tr>
              
          @empty
          <tr>
              <td colspan="11">
                  Non ci sono appartamenti
              </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
@vite('resources/js/delete_confirmation.js')
@endsection