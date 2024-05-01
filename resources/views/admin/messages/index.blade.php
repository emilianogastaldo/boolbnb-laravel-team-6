@extends('layouts.app')
@section('title', 'Lista messaggi')

@section('content')
<h1>PROVA</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome e Cognome</th>
            <th scope="col">Email</th>
            <th scope="col">Messaggio</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($messages as $message)
        <tr>

            <td>{{"$message->first_name $message->last_name"}}</td>
            <td>{{$message->email_sender}}</td>
            <td>{{$message->text}}</td>

            
        </tr>
            
        @empty
            
        @endforelse
    </tbody>
</table>
@endsection