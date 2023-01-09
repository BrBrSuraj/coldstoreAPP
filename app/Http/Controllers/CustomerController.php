<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Traits\Currency;

class CustomerController extends Controller
{
    use Currency;
    public function index()
    {
        $count=0;
        $customers=Customer::with('sales')->get();
        foreach ($customers as $customer) {
            $customer->sales->totalInCurrency = $this->currency($customer->sales->sum('total'));
            $customer->sale_payments->amountInCurrency = $this->currency($customer->sale_payments->sum('amount'));
        }
        return view('customer.index',compact('customers','count'));
    }

    public function store(StoreCustomerRequest $request)

    {
        Customer::create($request->validated());
        return \redirect()->route('users.customers.index')->with(['status'=>'Customer added successfully.']);
    }


    public function show(Customer $customer)
    {
        //
    }

 
    public function edit(Customer $customer)
    {
        return view('customer.edit',compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return redirect()->route('users.customers.index')->with(['status'=>'customer updated successfully.']);
    }

 
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('users.customers.index')->with(['status' => 'customer deleted successfully.']);
    }


    public function print(Customer $customer)
    {
        
    }
}
