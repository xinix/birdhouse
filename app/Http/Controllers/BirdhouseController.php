<?php

namespace App\Http\Controllers;

use App\Birdhouse;
use Illuminate\Http\Request;

class BirdhouseController extends Controller
{
    function index()
    {
        $birdhouses = Birdhouse::latest()->get();

        if (request()->wantsJson()) return $birdhouses;

        return view('birdhouses.index', compact('birdhouses'));
    }
}
