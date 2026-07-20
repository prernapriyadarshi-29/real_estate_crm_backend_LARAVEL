<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->get();

        return view('Admin.properties.index', compact('properties'));
    }
}