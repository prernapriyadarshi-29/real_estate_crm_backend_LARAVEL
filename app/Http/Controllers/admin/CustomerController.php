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
        return view('Admin.customer.show', compact('customers'));
    }

    public function block($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'is_active' => 0
        ]);

        return back()->with('success', 'Customer blocked successfully.');
    }

    public function activate($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'is_active' => 1
        ]);

        return back()->with('success', 'Customer activated successfully.');
    }
}