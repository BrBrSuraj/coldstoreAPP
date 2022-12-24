<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\Supplier;
use App\Traits\Currency;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Traits\NepaliDates;

class SupplierController extends Controller
{
    use Currency,NepaliDates;

    public function index()
    {
        $count = 0;
        // display the list of all supplier 
        $suppliers = Supplier::with('purcheses','payments')->get();
        foreach ($suppliers as $supplier) {
            $supplier->purcheses->totalInCurrency = $this->currency($supplier->purcheses->sum('total'));
            $supplier->payments->amountInCurrency = $this->currency($supplier->payments->sum('amount'));
        }
        return view('supplier.index', compact('suppliers','count'));
    }

    public function store(StoreSupplierRequest $request)
    {
        // to store new supplier
        Supplier::create($request->validated());
        return redirect()->route('users.suppliers.index')->with(['status' => 'Supplier Created Successfully.']);
    }


    public function edit(Supplier $supplier)
    {
       
        return view('supplier.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return \redirect()->route('users.suppliers.index')->with(['status' => 'Supplier Updated Successfully.']);
    }


    public function destroy(Supplier $supplier)
    {
        // softdelete the supplier
        $supplier->delete();
        return \redirect()->route('users.suppliers.index')->with(['status' => 'Supplier deleted successfylly.']);
    }

    public function printBilll($customer_id){
        $customer=Customer::where('id', $customer_id)->first();
        $sales= $customer->sales()->get();
        $paidAmount=$customer->sale_payments()->sum('amount');
        return view('print.print',compact('customer','sales','paidAmount'));
    }

}
