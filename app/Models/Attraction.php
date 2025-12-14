<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attraction extends Model
{
     use HasFactory;

    protected $fillable = [
    'name',
    'location',
    'adult_price',
    'child_price',
    'available_adult_tickets',
    'available_child_tickets',
    'description',
    'image',
    'latitude',
    'longitude',
    'visit_date',
    ];

}
