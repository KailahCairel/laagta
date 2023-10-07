<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'establishment_id',
        'price',
        'capacity', // Add the 'capacity' field
        // Add other room attributes here
    ];

    // Define relationships here, for example:
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
