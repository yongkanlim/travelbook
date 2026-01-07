<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attraction extends Model
{
    // allows Attraction model to use Model Factories (Generate fake data)
     use HasFactory;

    //  $fillable protects your database from mass assignment attacks.
    // It tells Laravel:
    // “Only these fields are allowed to be filled using user input.”
    //     (Mass Assignment)
    // Attraction::create($request->all()); [Create/Update]
    // Without $fillable, Laravel will block this operation.
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
