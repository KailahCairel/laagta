<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establishments;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }
}
