<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::where('is_featured', 1)
                                      ->where('approval_status', 'approved')
                                      ->latest()
                                      ->take(6)
                                      ->get();
        
        $allProperties = Property::where('approval_status', 'approved')
                                ->latest()
                                ->take(12)
                                ->paginate(12);

        return view('home', compact('featuredProperties', 'allProperties'));
    }
}