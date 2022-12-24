<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\SalePayment;
use App\Http\Requests\StoreSalePaymentRequest;
use App\Http\Requests\UpdateSalePaymentRequest;
use App\Http\Requests\StoreCustomerPaymentRequest;

class CustomerPaymentController extends Controller
{
  
    public function index(Customer $customer)
    {
        $count = 0;
        $sales = $customer->sales()->get();
        $salesForDropDown = $customer->sales()->where('status', 'uncomplete')->get();
        $sale_payments = $customer->sale_payments()->get();

        return view('sale_payment.index', compact('sale_payments', 'count', 'sales', 'customer', 'salesForDropDown'));
    }

  
    public function store(StoreCustomerPaymentRequest $request, Customer $customer)
    {
        // for store the payment from customer
        $sale_id = $request->sale_id;
        $reqAmount = $request->amount;

        $sale = Sale::where('id', $sale_id)->firstOrFail();
        $sale_payment_sum = SalePayment::where('sale_id', $sale->id)->sum('amount');

        $due = $sale->total - $sale_payment_sum;

        if (!$due) {
            return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['error' => 'Due Unavailable.']);
        }

        if ($due) {
            if ($due < $reqAmount) {
                return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['error' => 'Amount Exceded.']);
            }
            elseif ($due > $reqAmount) {
                $customer->sale_payments()->create($request->validated());
                return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['status' => 'Partial Amount Received.']);
            }
            elseif ($due == $reqAmount) {
                $customer->sale_payments()->create($request->validated());
                $sale->update(['status' => 'completed']);
                return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['status' => 'Complete Payment Received.']);
            }else{
                return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['error' => 'Request Denied !']);
            }
        }
    }

    public function edit(Customer $customer, $sale_payment_id)
    {
        $sale_payment = SalePayment::where('id', $sale_payment_id)->first();
        $sale_id = $sale_payment->sale_id;
        $sale = Sale::where('id', $sale_id)->first();

        $total = $sale->total;
        $paid = $sale->sale_payments()->sum('amount');
        $due = $total - $paid;
        if (!$due) {
            return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['error' => 'Due Amount Not Found,Unable To Edit.']);
        }

        return view('sale_payment.edit', compact('customer', 'sale_payment'));
    }

    public function update(UpdateSalePaymentRequest $request, Customer $customer, $sale_payment_id)
    {
        $sale_payment = SalePayment::where('id', $sale_payment_id)->first();
        $sale_id = $sale_payment->sale_id;
        $sale = Sale::where('id', $sale_id)->first();

        $total = $sale->total;
        $paid = $sale->sale_payments()->sum('amount');
        $due = $total - $paid;
        if ($due == $request->amount) {
            $sale_payment->update($request->validated());
            $sale->update(['status' => 'completed']);
            return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['status' => 'Payment Updated Completely.']);
        }elseif($due > $request->amount){
            $sale_payment->update($request->validated());

            return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['status' => 'Partial Payment Updated.']);
        }else{
            return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['error' => 'Not allow to edit.']);
        }
    }

  
    public function destroy(Customer $customer, $sale_payment_id)
    {
        $sale_payment = SalePayment::where('id', $sale_payment_id)->first();
        $sale_id = $sale_payment->sale_id;
        $sale = Sale::where('id', $sale_id)->first();

        $total = $sale->total;
        $paid = $sale->sale_payments()->sum('amount');
        $due = $total - $paid;
        if(!$due){
            return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['error' => 'Payment Completed,unable to Delete']);
        }
        if($due){
            SalePayment::where('id', $sale_payment_id)->delete();
            return \redirect()->route('users.customers.sale_payments.index', $customer)->with(['error' => 'payment deleted.']);
        }
       
       
    }
}
