<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendAttraction extends Model
{
    protected $fillable = ['name', 'location', 'description', 'rating'];
}
