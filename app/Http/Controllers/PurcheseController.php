<?php

namespace App\Http\Controllers;

use App\Models\Purchese;
use App\Models\Supplier;
use App\Traits\Currency;
use App\Models\FiscalYear;
use App\Traits\NepaliDates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePurcheseRequest;
use App\Http\Requests\UpdatePurcheseRequest;

class PurcheseController extends Controller
{
    use Currency, NepaliDates;

    public function index(Supplier $supplier, Request $request)
    {
        $count = 0;
        $purcheses = $supplier->purcheses()->get();
        foreach ($purcheses as $purchese) {
            $purchese->currency = $this->currency($purchese->total);
            $purchese->currencyRate = $this->currency($purchese->rate);
        }
        $data = \response()->json([
            'purcheses' => $purcheses,
            'supplier' => $supplier,
            'count' => $count
        ]);


        return view('purches.index', compact('purcheses', 'supplier', 'count', 'data'));
    }


    public function create(Supplier $supplier)
    {
        return view('purches.create', compact('supplier'));
    }


    public function store(StorePurcheseRequest $request, Supplier $supplier)
    {
        $total = $request->weight * $request->rate;
        $supplier->purcheses()->create($request->validated() + ['total' => $total, 'status' => 'uncomplete']);
        return redirect()->route('users.suppliers.purcheses.index', $supplier)->with(['status' => 'New Purches Created Successfully.']);
    }


    public function show(Purchese $purchese)
    {
        //
    }


    public function edit(Supplier $supplier, Purchese $purchese)
    {
        if ($supplier->id != $purchese->supplier_id) {
            abort(403);
        }

        if ($purchese->status == 'complete') {
            return redirect()->route('users.suppliers.purcheses.index', $supplier)->with(['error' => 'Payment already completed !']);
        }
        return view('purches.edit', compact('purchese', 'supplier'));
    }


    public function update(UpdatePurcheseRequest $request, Supplier $supplier, Purchese $purchese)
    {
        $total = $request->weight * $request->rate;
        $purchese->update($request->validated() + ['total' => $total]);
        return redirect()->route('users.suppliers.purcheses.index', $supplier)->with(['status' => 'Purches Update Successfully.']);
    }


    public function destroy(Supplier $supplier, Purchese $purchese)
    {
        $purchese->delete();
        return redirect()->route('users.suppliers.purcheses.index', $supplier)->with(['status' => 'Purches Deleted Successfully.']);
    }
}
