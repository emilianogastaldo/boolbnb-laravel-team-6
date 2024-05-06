@extends('layouts.app')

@section('title', 'Cestino')

@section('content')
<div class="table-responsive">
<table class="table align-middle m-0">
    {{-- Thead --}}
    <thead>
      <tr class="text-center">
        <th scope="col">Titolo</th>
        <th scope="col">Descrizione</th>
        <th scope="col">Indirizzo</th>
        <th scope="col">Dimensioni</th>
        <th scope="col">Bagni</th>
        <th scope="col">Stanze</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    {{-- Tbody --}}
    <tbody>
      @forelse ($flats as $flat)
      <tr class="text-center">
        <td>{{$flat->title}}</td>
        <td>{{$flat->description}}</td>
        <td>{{$flat->address}}</td>
        <td>{{$flat->sq_m}} m<sup>2</sup></td>
        <td>{{$flat->bed}}</td>
        <td>{{$flat->bathroom}}</td>
        <td>
          {{-- Restore --}}
          <form action="{{route('admin.flats.restore', $flat->id)}}" method="POST">                           
            @csrf
            @method('PATCH')
            <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-arrow-rotate-left"></i></button>
          </form>            
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7">Non ci sono appartamenti</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<a href="{{route('admin.flats.index')}}" class="btn btn-secondary mt-3"><i class="fa-solid fa-arrow-left me-2"></i>Torna indietro</a>

@endsection