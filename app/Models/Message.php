<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'flat_id',
        'first_name',
        'last_name',
        'email_sender',
        'text',
    ];
    // Relazione con l'appartamento
    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
