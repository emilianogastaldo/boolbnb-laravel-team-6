@extends('layouts.app')
@section('title', 'Lista messaggi')

@section('content')
<h1>PROVA</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Appartamento</th>
            <th scope="col">Nome e Cognome</th>
            <th scope="col">Email</th>
            <th scope="col">Messaggio</th>
            <th scope="col">Ricevuto</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($messages as $message)
        <tr>
            <td>{{$message->flat->title}}</td>            
            <td>{{"$message->first_name $message->last_name"}}</td>
            <td>{{$message->email_sender}}</td>
            <td>{{$message->text}}</td>
            <td>{{$message->created_at}}</td>
        </tr>
            
        @empty
        <tr>
            <td colspan="5">
                Non ci sono messaggi
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection