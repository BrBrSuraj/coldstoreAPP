<?php

namespace App\Http\Controllers;

use App\Models\Purchese;
use App\Models\Supplier;
use App\Traits\NepaliDates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurcheseReportController extends Controller
{
    use NepaliDates;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count=1;
        $chkid = 1;
         $purcheses=Purchese::with('supplier','payments')->latest('id')->get();
      $suppliers=Supplier::with('purcheses','payments')->latest()->get();
      


        return view('myreport.index',compact( 'purcheses','count', 'suppliers','chkid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $count = 1;
        $suppliers=Supplier::where('id',$id)->with('payments')->first();
        return view('myreport.show',compact('suppliers','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function purchesePaymentList($id){
        $count=1;
        $supplier=Supplier::where('id',$id)->first();
        $payments=$supplier->payments;
        return view('myreport.supplierPaymentIndex',compact('supplier','payments','count'));
    }
}
