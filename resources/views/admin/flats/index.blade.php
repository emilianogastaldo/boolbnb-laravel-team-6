@extends('layouts.app')
@section('content')

<form class="d-flex justify-content-end align-items-center" action="{{ route('admin.flats.index') }}" method="GET">
  <div class="input-group w-25 p-3">
    <input type="search" name="search" class="form-control" placeholder="Cerca..." value="{{ $search }}" autofocus>
    <button type="submit" class="input-group-text" id="basic-addon2"><i class="fas fa-magnifying-glass"></i></button>
  </div>
</form>

<table class="table table-dark table-striped my-3">
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
                <a href="{{route('admin.flats.show', $flat->id)}}"><i class="fa-solid fa-eye"></i></a>
                <form action="{{route('admin.flats.destroy', $flat->id)}}" method="POST">                           
                  @csrf
                  @method('DELETE')
                  <button type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </td>
       </tr>
      @empty
          <h1>NON CI SONO APPARTAMENTI</h1>
      @endforelse
    </tbody>
  </table>
@endsection