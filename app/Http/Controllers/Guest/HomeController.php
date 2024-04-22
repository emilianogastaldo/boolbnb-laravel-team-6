<?php

namespace App\Http\Controllers\Guest;

use App\Models\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {

        $flats = Flat::orderByDesc('created_at')->get();

        return view('guest.home', compact('flats'));
    }

    public function show(Flat $flat)
    {

        return view('guest.flats.show', compact('flat'));
    }
    
    
}
