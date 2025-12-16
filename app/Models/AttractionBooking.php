<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionBooking extends Model
{
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
    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }

}
