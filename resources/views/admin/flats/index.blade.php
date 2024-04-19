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
            </div>
        </td>
       </tr>
      @empty
          <h1>NON CI SONO APPARTAMENTI</h1>
      @endforelse
    </tbody>
  </table>
@endsection