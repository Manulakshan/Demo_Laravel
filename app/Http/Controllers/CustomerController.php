<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customers.customer', ['customers' => $customers]);
    }
    
    public function create(){
        return view('customers.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'status' => 'required|in:active,N/A'

        ]);

        $newCustomer = Customer::create($data);

        return redirect(route('customers.customer'));


    }

    public function edit(Customer $customer){
        return view('customers.edit', ['customer' => $customer]);
    }

    public function update(Customer $customer, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',   
            'status' => 'required|in:active,N/A'
    
         ]);

         $customer->update($data);

         return redirect(route('customers.customer'))->with('success','Product Updated Successfully');
    }

    // app/Http/Controllers/CustomerController.php
public function destroy(Customer $customer)
{
    $customer->delete();
    return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
}

}

    
