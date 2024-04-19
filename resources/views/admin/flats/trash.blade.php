@extends('layouts.app')
@section('content')
<table class="table table-dark table-striped container my-5">
    {{-- Thead --}}
    <thead>
      <tr>
        <th scope="col">Titolo</th>
        <th scope="col">Descrizione</th>
        <th scope="col">Indirizzo</th>
        <th scope="col">Dimensioni</th>
        <th scope="col">Bagni</th>
        <th scope="col">Stanze</th>
        <th></th>
      </tr>
    </thead>
    {{-- Tbody --}}
    <tbody>
      @forelse ($flats as $flat)
      <tr>
        <td>{{$flat->title}}</td>
        <td>{{$flat->description}}</td>
        <td>{{$flat->address}}</td>
        <td>{{$flat->sq_m}}</td>
        <td>{{$flat->bed}}</td>
        <td>{{$flat->bathroom}}</td>
        <td>
            <div class="d-flex justify-content-end gap-3">
                {{-- Show --}}
                <a href="{{route('admin.flats.show', $flat->id)}}"><i class="fa-solid fa-eye"></i></a>
                {{-- Edit --}}
                <a href="{{route('admin.flats.edit', $flat->id)}}"><i class="fa-solid fa-pencil"></i></a>
                {{-- Drop --}}
                <form action="{{route('admin.flats.drop', $flat->id)}}" method="POST">                           
                  @csrf
                  @method('DELETE')
                  <button type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
                {{-- Restore --}}
                <form action="{{route('admin.flats.restore', $flat->id)}}" method="POST">                           
                  @csrf
                  @method('PATCH')
                  <button type="submit"><i class="fas fa-arrow-rotate-left"></i></button>
                </form>
            </div>
        </td>
       </tr>
      @empty
          <h1>Non ci sono appartamenti</h1>
      @endforelse
    </tbody>
  </table>
@endsection