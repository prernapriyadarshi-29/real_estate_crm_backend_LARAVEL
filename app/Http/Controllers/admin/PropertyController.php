<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('user')->latest()->get();
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

    public function markFeatured($id)
{
    $property = Property::findOrFail($id);
    $property->is_featured = 1;
    $property->save();
    return back()->with('success', 'Property marked as featured');
}

public function unmarkFeatured($id)
{
    $property = Property::findOrFail($id);
    $property->is_featured = 0;
    $property->save();
    return back()->with('success', 'Property removed from featured');
}
}