<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionBooking extends Model
{
    //     (Mass Assignment)
    // Attraction::create($request->all()); [Create/Update]
    // Without $fillable, Laravel will block this operation.
    protected $fillable = [
    'user_id',
    'attraction_id',
    'adult_tickets',
    'child_tickets',
    'total_price',
    'visit_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // <!-- Eloquent relationships (Connect tables & no need write SQL join)
    // ==============================================================================================
    //  $booking->attraction
    //  Means a / each booking belongs to an attraction
    //  To use this:
    //  1. Table attractions - id, name   | attraction_bookings - id, attraction_id (need FK here)
    //  2. Go to attractionbooking model, define attraction() function (booking belongsTo attraction)
    //-->
    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }

}
