<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'address', 'bed', 'bathroom', 'sq_m', 'latitude', 'longitude', 'image', 'is_visible'];
}
