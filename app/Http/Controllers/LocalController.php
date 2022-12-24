<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLocalRequest;
use App\Http\Requests\UpdateLocalRequest;

class LocalController extends Controller
{
    public function index()
    {
        $count=0;
        $locals=Local::paginate();
        return view('local.index',compact('locals','count'));
    }

  
    public function store(StoreLocalRequest $request)
    {
        Local::create($request->validated()+['total'=>($request->weight*$request->rate)]);
        return redirect()->route('users.locals.index')->with(['status'=>'New Local Sale Created.']);
    }

   
    public function edit(Local $local)
    {
        if($local->user_id != auth()->id()){
            abort(403);
        }
        return view('local.edit',compact('local'));
    }

    
    public function update(UpdateLocalRequest $request, Local $local)
    {
        $local->update($request->validated()+['total'=>($request->weight*$request->rate)]);
        return redirect()->route('users.locals.index')->with(['status' => 'Local Sale Updated.']);
    }

    public function destroy(Local $local)
    {
        $local->delete();
        return redirect()->route('users.locals.index')->with(['status' => 'Local Sale deleted.']);

    }
}
