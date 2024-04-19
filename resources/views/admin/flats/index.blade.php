@extends('layouts.app')
@section('content')
@if (session('message'))
<strong>{{session('message')}}</strong>
 @endif
<a href="{{route('admin.flats.trash')}}"><i class="fas fa-trash-can"></i></a>
<table class="table table-dark table-striped container my-5">
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