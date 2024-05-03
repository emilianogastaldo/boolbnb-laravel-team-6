@extends('layouts.app')

@section('title', 'Lista appartamenti')

@section('content')

<div class="container">
  <form class="d-flex justify-content-end align-items-center mb-5 mt-3" action="{{ route('admin.flats.index') }}" method="GET">
    <div class="input-group w-25 p-3">
      <input type="search" name="search" class="form-control" placeholder="Cerca..." value="{{ $search }}" autofocus>
      <button type="submit" class="input-group-text" id="basic-addon2"><i class="fas fa-magnifying-glass"></i></button>
    </div>
  </form>
  <div class="d-flex gap-3 justify-content-end p-3">
    {{-- Go to trash page button --}}
    <a href="{{route('admin.flats.trash')}}" class="btn btn-sm trash">
      {{-- <i class="fas fa-trash-can"></i> --}} Vedi cestino
    </a>
    {{-- Add flat Button --}}
    <a href="{{route('admin.flats.create')}}" class="btn btn-sm create">
        {{-- <i class="fas fa-plus me-2"></i>--}} Aggiungi appartamento
    </a>
  </div>
  <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
    <table class="table">
      <thead>
          <tr>
              <th scope="col">Appartamento</th>
              <th scope="col">Indirizzo</th>
              <th scope="col">Stanze</th>
              <th scope="col">Letti</th>
              <th scope="col">Bagni</th>
              <th scope="col">Metratura</th>
              <th scope="col">Azioni</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($flats as $flat)
          <tr>
              <td>{{$flat->title}}</td>            
              <td>{{$flat->address}}</td>
              <td>{{$flat->room}}</td>
              <td>{{$flat->bed}}</td>
              <td>{{$flat->bathroom}}</td>
              <td>{{$flat->sq_m}}</td>
              <td>
                <div class="row"></div>
                <a href="{{route('admin.flats.show', $flat->id)}}" class="btn btn-sm btn-primary">
                  {{-- <i class="fas fa-eye"></i> --}} VISUALIZZA
                </a>
                <a href="{{route('admin.flats.edit', $flat->id)}}" class="btn btn-sm btn-warning">
                  {{-- <i class="fas fa-pencil"></i> --}} MODIFICA
                </a>
                <form class="delete" action="{{route('admin.flats.destroy', $flat->id)}}" method="POST">                           
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit">
                    {{-- <i class="fas fa-trash-can"></i> --}} ELIMINA
                  </button>
                </form>
                <a href="{{route('admin.messages.flat', $flat)}}" class="btn btn-sm btn-info" href="">MESSAGGI</a>
              </td>
          </tr>
              
          @empty
          <tr>
              <td colspan="4">
                  Non ci sono messaggi
              </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
@vite('resources/js/delete-confirmation.js')
@endsection