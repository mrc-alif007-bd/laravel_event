<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'city',
        'capacity',
        'description',
        'status',
        'image',
    ];

    // Relationships
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
