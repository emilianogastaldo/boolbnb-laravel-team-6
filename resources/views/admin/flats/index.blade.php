@extends('layouts.app')

@section('title', 'Flats')

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
        <th>
          <div class="d-flex align-items-center justify-content-end gap-3">
            {{-- Go to trash page button --}}
            <a href="{{route('admin.flats.trash')}}"><i class="fas fa-trash-can"></i></a>

            {{-- Add flat Button --}}
            <a href="{{route('admin.flats.create')}}" class="btn btn-sm btn-success">
                <i class="fas fa-plus me-2"></i>New Flat
            </a>
          </div>
        </th>
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
                {{-- Show Button --}}
                <a href="{{route('admin.flats.show', $flat->id)}}" class="btn btn-sm btn-primary">
                  <i class="fas fa-eye"></i>
                </a>

                {{-- Edit Button --}}
                <a href="{{route('admin.flats.edit', $flat->id)}}" class="btn btn-sm btn-warning">
                  <i class="fas fa-pencil"></i>
                </a>

                {{-- Delete Button --}}
                <form action="{{route('admin.flats.destroy', $flat->id)}}" method="POST">                           
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit">
                    <i class="fas fa-trash-can"></i>
                  </button>
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