<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'address', 'bed', 'bathroom', 'sq_m', 'latitude', 'longitude', 'image', 'is_visible'];

    // Relazione con l'utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relazione con i messaggi
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    // Relazione con le visualizzazioni
    public function views()
    {
        return $this->hasMany(View::class);
    }
    // Relazione con le sponsorship
    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }
    // Relazione con i servizi
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
