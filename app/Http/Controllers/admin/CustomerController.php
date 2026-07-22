<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('Admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('Admin.customers.show', compact('customer'));
    }

    public function block($id)
{
    $customer = Customer::findOrFail($id);
    $customer->is_active = 0;
    $customer->save();
    return back()->with('success', 'Customer blocked successfully.');
}

    public function activate($id)
{
    $customer = Customer::findOrFail($id);
    $customer->is_active = 1;
    $customer->save();
    return back()->with('success', 'Customer activated successfully.');
}
}