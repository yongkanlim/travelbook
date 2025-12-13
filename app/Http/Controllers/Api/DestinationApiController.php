<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationApiController extends Controller
{
    public function index() {
    return Destination::all();
    }
}
