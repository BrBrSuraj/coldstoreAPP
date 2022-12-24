<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Traits\Currency;
use App\Models\FiscalYear;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    use Currency;
  
    public function index(Customer $customer)
    {
        $count = 0;
    
        $sales = $customer->sales()->get();
        foreach ($sales as $sale) {
            $sale->currency = $this->currency($sale->total);
            $sale->currencyRate = $this->currency($sale->rate);
        }
    
        return view('sale.index',compact('sales','customer','count'));
    }

    public function store(StoreSaleRequest $request,Customer $customer)
    {
        $customer->sales()->create($request->validated()+['total'=>($request->weight)*($request->rate),'status'=>'uncomplete']);
        return \redirect()->route('users.customers.sales.index',$customer)->with(['status'=>'New Sale Creaated Successfully.']);
        
    }

    public function edit(Customer $customer,Sale $sale)
    {
        if($sale->status=='completed'){
            return \to_route('users.customers.sales.index', ['customer' => $customer, 'sale' => 'sale'])->with(['error' => 'Payment Already Received, Unauthorized access.']);
        }
        return view('sale.edit',compact('sale','customer'));
    }

    public function update(UpdateSaleRequest $request,Customer $customer,Sale $sale)
    {
         $sale->update($request->validated()+['total'=>($request->weight)*($request->rate)]);
         return \to_route('users.customers.sales.index',['customer'=>$customer,'sale'=>'sale'])->with(['status'=>'sale updated successfully.']);
    }

  
    public function destroy(Customer $customer,Sale $sale)
    {
        if ($sale->status == 'completed') {
            return \to_route('users.customers.sales.index', ['customer' => $customer, 'sale' => 'sale'])->with(['error' => 'Payment Already Received, Unable to delete.']);
        }
        $sale->delete();
        return \to_route('users.customers.sales.index', ['customer' => $customer, 'sale' => 'sale'])->with(['status' => 'sale deleted successfully.']);
    }
   
}
