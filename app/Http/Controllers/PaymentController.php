<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Supplier;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Purchese;
use App\Traits\Currency;
use App\Traits\NepaliDates;

class PaymentController extends Controller
{
    use Currency, NepaliDates;

    public function index(Supplier $supplier)
    {
        $count = 0;
        // display the list of payment of $supplier 
        $payments =  $supplier->payments()->get();
        $supplierPurchese = $supplier->purcheses()->get();
        $purcheses = $supplier->purcheses()->where('status', 'uncomplete')->get();

        foreach ($payments as $payment) {
            $payment->amountInCurrency = $this->currency($payment->amount);
        }
        $purchesesTotalWeight = $supplier->purcheses()->sum('weight');
        $purchesesTotalAmount = $supplier->purcheses()->sum('total');
        $paymentTotalPaid =  $supplier->payments()->sum('amount');

        return view('payment.index', compact('payments', 'supplier', 'purcheses', 'count', 'supplierPurchese'));
    }


    public function store(StorePaymentRequest $request, Supplier $supplier)
    {
        $purchese = Purchese::where('id', $request->purchese_id)->first();
        $purcheseFy = $purchese->fy;
        $currentFy = $this->getFy();
        if ($purcheseFy != $currentFy) {
            return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['error' => "Try to pay other fiscal year purchese."]);
        }
        $price = $purchese->total;
        $status = $purchese->status;
        $paid = $purchese->payments()->sum('amount');
        $due = $price - $paid;
        $requestAmount = $request->amount;

        if ($due > 0) {

            if ($requestAmount <= $due) {
                $supplier->payments()->create($request->validated());
                $paid = $purchese->payments()->sum('amount');
                if ($paid == $price) {
                    Purchese::where('id', $purchese->id)->update(['status' => 'complete']);
                    return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['status' => "payment success with status updated."]);
                } else {
                    return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['status' => "payment successes."]);
                }
            } else {
                return \redirect()->route('users.suppliers.purcheses.index', $supplier)->with(['error' => "Requested much amount than due amout."]);
            }
        } else {
            return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['error' => "No Due Amount Found."]);
        }
    }

    public function edit(Supplier $supplier, Payment $payment)
    {
        $purcheseStatus = $payment->purchese->status;
        if ($purcheseStatus == 'complete') {
            return redirect()->route('users.suppliers.payments.index', $supplier)->with(['error' => 'Payment Already Completed,Unexpected Request !']);
        }
        return view('payment.edit', compact('supplier', 'payment'));
    }


    public function update(UpdatePaymentRequest $request, Supplier $supplier, Payment $payment,)
    {
        $purchese = Purchese::where('id', $payment->purchese_id)->first();
        $total = $purchese->total;
        $paid = $purchese->payments()->sum('amount');
        $due = $total - $paid;
        if (!$due) {
            return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['error' => 'Due Not Found']);
        }

        if ($due) {
            if ($request->amount > $due) {

                return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['status' => 'Amount Exceded !']);
            }
            if ($request->amount == $due) {
                $payment->update($request->validated());
                $purchese->update(['status' => 'completed']);
                return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['status' => 'Complete Payment Updated Successfully.']);
            }
            if ($request->amount < $due) {
                $payment->update($request->validated());
                return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['status' => 'Partial Payment Updated Successfully.']);
            }
        }
    }


    public function destroy(Supplier $supplier, Payment $payment)
    {
        $purcheseStatus = $payment->purchese->status;
        if ($purcheseStatus == 'complete') {
            return redirect()->route('users.suppliers.payments.index', $supplier)->with(['error' => 'Payment Already Completed,Unable to delete !']);
        }
        $payment->delete();
        return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['status' => 'Payment Deleted.']);
    }
}
