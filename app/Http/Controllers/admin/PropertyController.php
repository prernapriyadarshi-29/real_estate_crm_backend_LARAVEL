<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->get();
        return view('Admin.properties.index', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('Admin.properties.show', compact('property'));
    }

    public function approve($id)
    {
        $property = Property::findOrFail($id);
        $property->update(['approval_status' => 'approved']);
        return back()->with('success', 'Property approved successfully');
    }

    public function reject($id)
    {
        $property = Property::findOrFail($id);
        $property->update(['approval_status' => 'rejected']);
         return back()->with('success', 'Property rejected successfully');
    }
}