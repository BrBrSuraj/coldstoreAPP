<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\SalePayment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSalePaymentRequest;
use App\Http\Requests\UpdateSalePaymentRequest;
use App\Traits\NepaliDates;

class SalePaymentController extends Controller
{
    use NepaliDates;
    public function index(Customer $customer, Sale $sale)
    {
        $count = 0;
        $sale_payments = $sale->sale_payments()->get();
        return view('sale_payment.salePaymentIndex', compact('sale_payments', 'customer', 'sale', 'count'));
    }

    public function create()
    {
        //
    }

   
    public function store(StoreSalePaymentRequest $request, Customer $customer, Sale $sale,)
    {
        $reqAmount = $request->amount;
        $salePayment= $sale->sale_payments()->sum('amount');
        $due = $sale->total- $salePayment;
        $saleFy = $sale->fy;
        $currentFy = $this->getFy();
        if ($saleFy != $currentFy) {
            return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => "Try to pay other fiscal year sales."]);
        }
   
        // due is empty
        if(!$due){
            return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => 'Payment Already Received Completely.']);
        }

        // due exist sale payment received empty
        if($due && !$salePayment){
         
            if($due== $reqAmount){
                SalePayment::create($request->validated() + ['sale_id' => $sale->id]);
                $sale->update(['status' => 'completed']);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'Complete Payment Received.']);
            }
            if($due>$reqAmount){
                SalePayment::create($request->validated() + ['sale_id' => $sale->id]);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'Partial payment received successfullu.']);
            }
            if ($reqAmount > $due) {
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => 'Amount Exceded !']);
            }
        }
//both due and sale payment received exist 
        if($due && $salePayment){
            // $paid = $salePayment + $reqAmount;
            if($due > $reqAmount){
                SalePayment::create($request->validated() + ['sale_id' => $sale->id]);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'partial payment received.']);
            }
            if($due == $reqAmount){
                SalePayment::create($request->validated() + ['sale_id' => $sale->id]);
                $sale->update(['status' => 'completed']);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'Complete Payment Received']);
            }

            if($due > $reqAmount){
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => 'This Not Allowed !']);
            }
        }
    }

    public function edit(Customer $customer, Sale $sale, SalePayment $salePayment)
    {
        $due= $sale->total- $sale->sale_payments()->sum('amount');
        if(!$due){
            return redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => 'Due Amount Not Found.']);
        }
        return view('sale_payment.salePaymentEdit', compact('customer', 'sale', 'salePayment'));
    }

   
    public function update(UpdateSalePaymentRequest $request, $customer, $sale, $sale_payment)
    {
        $reqAmount = $request->amount;
        $sold = Sale::where('id', $sale)->first();
        $soldPayment = $sold->sale_payments()->sum('amount');
        $due = $sold->total -  $soldPayment;

        /**
         * Update the specified resource in storage.
         *if due is false return with error message
         */
        if (!$due) {
            return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => 'Due Amount Not Found.']);
        }

        /**
         * Update the specified resource in storage.
         *
         * if due exist bit sold payment is null
         */
        if ($due && !$soldPayment) {

            if ($reqAmount > $due) {
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => 'Amount Exceded !.']);
            } 
            if ($reqAmount == $due) {
                SalePayment::where('id', $sale_payment)->update(['amount' => $request->amount]);
                $sold->update(['status' => 'completed']);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'Complete Payment Received.']);
            } 
            if ($reqAmount < $due) {
                SalePayment::where('id', $sale_payment)->update(['amount' => $request->amount]);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'Partial Payment Received.']);
            }
        } 
        
        if ($due && $soldPayment) {
            if ($due < ($soldPayment + $reqAmount)) {
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['error' => 'This not allowed !']);
            }
            if ($due == ($soldPayment + $reqAmount)) {
                SalePayment::where('id', $sale_payment)->update(['amount' => $request->amount]);
                $sold->update(['status' => 'completed']);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'Complete Payment Received.']);
            } 
            if ($due > ($soldPayment + $reqAmount)) {
                SalePayment::where('id', $sale_payment)->update(['amount' => $request->amount]);
                return \redirect()->route('users.customers.sales.sale_payments.index', ['sale' => $sale, 'customer' => $customer])->with(['status' => 'Partial Payment Received']);
            } 
          
        }
    }
}
