@extends('layouts.app')
@section('content')
<table class="table table-dark table-striped container my-5">
    <thead>
      <tr>
        <th scope="col">TITOLO</th>
        <th scope="col">DESCRIZIONE</th>
        <th scope="col">INDIRIZZO</th>
        <th scope="col">DIMENSIONI</th>
        <th scope="col">NUMERO BAGNI</th>
        <th scope="col">NUMERO STANZE</th>
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
                <form action="{{route('admin.flats.drop', $flat->id)}}" method="POST">                           
                  @csrf
                  @method('DELETE')
                  <button type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
                <form action="{{route('admin.flats.restore', $flat->id)}}" method="POST">                           
                  @csrf
                  @method('PATCH')
                  <button type="submit"><i class="fas fa-arrow-rotate-left"></i></button>
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