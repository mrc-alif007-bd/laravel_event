<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'venue_id',
        'category_id',
        'event_date',
        'start_time',
        'end_time',
        'is_paid',
        'price',
        'total_tickets',
        'available_tickets',
        'sale_start_at',
        'sale_end_at',
        'status',
        'image',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'sale_start_at' => 'datetime',
        'sale_end_at' => 'datetime',
    ];

    // Relationships

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
