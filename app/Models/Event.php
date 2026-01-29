<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'venue_id',
        'price',
        'description',
        'category_id',
        'status',                
        'image',                
        
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

}
