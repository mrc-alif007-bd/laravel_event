<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'venue_id',
        'title',
        'price',
        'description',
        'status',
        'image',
    ];

    // 🔗 Event belongs to a Venue
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    // 🔗 Event belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
