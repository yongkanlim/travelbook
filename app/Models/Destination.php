<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','location','price','people','latitude','longitude','available_rooms'];
    public function bookings() {
    return $this->hasMany(Booking::class);
    }
}
