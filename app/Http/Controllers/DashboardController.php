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

    $purchesePayment = Payment::sum('amount');
    $salePayment = SalePayment::sum('amount');
    $localPayment = Local::sum('total');
    $amount = ($salePayment+$localPayment) - $purchesePayment;
    $profit = null;
    $loss = null;
    if ($amount > 0) {
      $profit = $amount;
    }else{
      $loss= (-($amount));
    }
    $suppliers=Supplier::with('purcheses')->get();
    $purcheses=Purchese::get();
    $payments=Payment::get();
    $customers = Customer::with('sales')->get();
    $sales = Sale::get();
    $sale_payments = SalePayment::get();
    $locals=Local::get();
    return view('dashboard', compact('suppliers', 'customers','purcheses','sales', 'payments','sale_payments','locals','profit','loss'));
    // _____________________________________________________


    /**
     * for chart data
    
    $purchesesResult = $purcheses->map(function ($item) {
      $item->data = ['month' => Carbon::parse($item->created_at)->format('M'), 'amount' => $item->total];
      return $item;
    })->pluck('data');
    $dataP = "";
    foreach ($purchesesResult as $val) {
      $dataP .= "  [" . $val['month'] . ",     " . $val['amount'] . "],";
    }

    $salesResult = $sales->map(function ($item) {
      $item->data = ['month' => Carbon::parse($item->created_at)->format('M'), 'amount' => $item->total];
      return $item;
    })->pluck('data');
    $dataS = "";
    foreach ($salesResult as $val) {
      $dataS .= "['".$val['month']."',  ".$val['amount']."],";
    }

     */
  }
}
