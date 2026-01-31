<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',           // optional, if logged-in users
        'event_id',
        'number_of_ticket',
        'total_amount',
        'status',            // booking status: pending, confirmed, canceled
        'name',
        'email',
        'phone',

        // Payment info
        'payment_method',    // e.g., stripe, paypal
        'payment_status',    // pending, paid, failed
        'transaction_id',    // transaction identifier
    ];
}
