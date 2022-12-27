<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Local;
use App\Models\Purchese;
use App\Models\Sale;
use App\Models\Supplier;
use App\Traits\Currency;
use App\Models\SalePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  use Currency;

  public function __invoke(Request $request)
  {

    $purchesePayment = Payment::withoutGlobalScopes()->sum('amount');
    $salePayment = SalePayment::withoutGlobalScopes()->sum('amount');
    $localPayment = Local::withoutGlobalScopes()->where('credit',0)->sum('total');
    $amount = ($salePayment+$localPayment) - $purchesePayment;
    $profit = null;
    $loss = null;
    if ($amount > 0) {
      $profit = $amount;
    }else{
      $loss= (-($amount));
    }
    $suppliers=Supplier::withoutGlobalScopes()->with('purcheses')->get();
    $purcheses=Purchese::withoutGlobalScopes()->get();
    $payments=Payment::withoutGlobalScopes()->get();
    $customers = Customer::withoutGlobalScopes()->with('sales')->get();
    $sales = Sale::withoutGlobalScopes()->get();
    $sale_payments = SalePayment::withoutGlobalScopes()->get();
    $locals=Local::withoutGlobalScopes()->get();
    return view('dashboard', compact('suppliers', 'customers','purcheses','sales', 'payments','sale_payments','locals','profit','loss'));
    // ____________________________________________________
  }
}
