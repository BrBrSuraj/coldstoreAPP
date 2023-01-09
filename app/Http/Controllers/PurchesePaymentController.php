<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Purchese;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierPurchesePaymentRequest;
use App\Http\Requests\UpdateSupplierPurchesePaymentRequest;
use App\Traits\Currency;
use App\Traits\NepaliDates;

class PurchesePaymentController extends Controller
{
    use Currency, NepaliDates;

    public function index(Supplier $supplier, Purchese $purchese)
    {
        $count = 0;
        $payments = $purchese->payments()->get();
        foreach ($payments as $payment) {
            $payment->amountInCurrency = $this->currency($payment->amount);
        }
        Payment::where('purchese_id', $purchese->id)->where('amount', 0)->delete();
        return view('payment.purchesePaymentIndex', \compact('purchese', 'supplier', 'payments', 'count'));
    }


    public function create(Supplier $supplier, Purchese $purchese)
    {
        $due = $purchese->getDueAmount();
        // dd($due);
        return view('payment.purchesePaymentCreate', compact('supplier', 'purchese', 'due'));
    }


    public function store(StoreSupplierPurchesePaymentRequest $request, Payment $payment, Supplier $supplier, Purchese $purchese)
    {
        $total = $purchese->total;
        $paid = $purchese->payments()->sum('amount');
        $due = $total - $paid;
        $requestAmount = $request->amount;
        $purcheseFy = $purchese->fy;
        $currentFy = $this->getFy();
        if ($purcheseFy != $currentFy) {
            return \redirect()->route('users.suppliers.payments.index', $supplier)->with(['error' => "Try to pay other fiscal year purchese."]);
        }
        if (!$due) {
            return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['error' => "Due Amount Not Found"]);
        }

        if ($due && !$paid) {

            if ($requestAmount > $due) {

                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['error' => "Amount Exceded."]);
            }
            if ($requestAmount == $due) {
                $purchese->payments()->create($request->validated());
                Purchese::where('id', $purchese->id)->update(['status' => 'complete']);
                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['status' => "Payment Completed"]);
            }

            if ($requestAmount < $due) {
                $purchese->payments()->create($request->validated());
                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['status' => "Partial Payment Completed."]);
            }
        }

        if ($due && $paid) {
            if ($due == ($requestAmount)) {
                $purchese->payments()->create($request->validated());
                Purchese::where('id', $purchese->id)->update(['status' => 'complete']);
                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['status' => "Payment Completed"]);
            }
            if ($due > ($requestAmount)) {
                $purchese->payments()->create($request->validated());
                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['status' => "Partial Payment Completed."]);
            }

            if ($due < ($requestAmount)) {

                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['error' => "Amount Exceded.Amount"]);
            }
        }
    }

    public function edit(Supplier $supplier, Purchese $purchese, Payment $payment)
    {
        if ($purchese->status == 'complete') {
            return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['error' => "Purchese has already completed the payment,access denied !"]);
        }
        return view('payment.purchesePaymentEdit', compact('supplier', 'purchese', 'payment'));
    }


    public function update(UpdateSupplierPurchesePaymentRequest $request, Supplier $supplier, Purchese $purchese, Payment $payment)
    {
        $reqAmount = $request->amount;
        $total = $purchese->total;
        $paid = $purchese->payments()->sum('amount');
        $due = $total - $paid;
        $currentFy = $this->getFy();
        if ($purchese->fy != $currentFy) {
            return \redirect()->route('users.suppliers.purcheses.payments.index', $supplier)->with(['error' => "Try to pay other fiscal year purchese."]);
        }
        if (!$due) {
            return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['erroe' => "Due Amount not found !"]);
        }
        if ($due) {
            if ($due < $reqAmount) {
                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['error' => "Amount Exceded."]);
            }
            if ($due == $reqAmount) {
                $payment->update($request->validated());
                $purchese->update(['status' => 'completed']);
                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese, 'payment' => $payment])->with(['status' => "payment Completed."]);
            }

            if ($due > $reqAmount) {
                $payment->update($request->validated());
                return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese,  'payment' => $payment])->with(['status' => "Partial payment Completed."]);
            }
        }
    }

    public function destroy(Supplier $supplier, Purchese $purchese, Payment $payment)
    {
        $total = $purchese->total;
        $paid = $purchese->payments()->sum('amount');
        $due = $total - $paid;
        if (!$due) {
            return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese,  'payment' => $payment])->with(['error' => "Due Amount Completed. Unable to delete"]);
        }
        if ($due) {
            $payment->delete();
            return \redirect()->route('users.suppliers.purcheses.payments.index', ['supplier' => $supplier, 'purchese' => $purchese,  'payment' => $payment])->with(['status' => "Payment Deleted Successfully"]);
        }
    }
}
