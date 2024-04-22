@extends('layouts.app')

@section('title', 'Home Guest')

@section('content')

<div class="jumbotron p-2 mb-4 rounded-3">
    <div class="container py-5">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @forelse ($flats as $flat)   
            <div class="carousel-item active">
            <div class="card">
            <div class="card-body">
                <figure>
                    <img src="{{ $flat->printImage() }}" alt="{{ $flat->title }}">
                </figure>
                <div>
                    <h2>{{ $flat->title }}</h2>
                    <p>{{ $flat->abstract() }}...</p>
                </div>
            </div>
            </div>
            @empty
            <h3>Non ci sono appartamenti</h3>
            @endforelse
        </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    </div>
</div>

<div class="content">
    <div class="container">
        
    </div>
</div>
@endsection