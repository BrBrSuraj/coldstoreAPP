<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Purchese;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('is_admin');
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }


    public function create()
    {
        $this->authorize('is_admin');
        $roles = Role::select('id', 'name')->get();
        return view('users.create', compact('roles'));
    }


    public function store(StoreUserRequest $request)
    {
        $this->authorize('is_admin');
        User::create($request->validated() + ['password' => \bcrypt('nepal@321')]);
        return \redirect()->route('admin.users.index')->with(['status' => 'User created successfully.']);
    }


    public function show(User $user)
    {
        $this->authorize('is_admin');
        if ($user->role->name == 'admin') {
            return \redirect()->route('admin.users.index')->with(['error' => 'Try to access own data from user, use supplier or customer menu.']);
        }
        $totalPurchese = DB::table('purcheses')->where('user_id', $user->id)->sum('weight');
        $totalPurcheseCost = DB::table('purcheses')->where('user_id', $user->id)->sum('total');
        $totalPaid = DB::table('payments')->where('user_id', $user->id)->sum('amount');

        $totalSale = DB::table('sales')->where('user_id', $user->id)->sum('weight');
        $totalSaleAmount = DB::table('sales')->where('user_id', $user->id)->sum('total');
        $totalPaymentReceived = DB::table('sale_payments')->where('user_id', $user->id)->sum('amount');

        $suppliers = DB::table('suppliers')->where('user_id', $user->id)->paginate(5);
        $customers = DB::table('customers')->where('user_id', $user->id)->paginate(5);

       
        return view(
            'users.show',
            compact(
                'user',
                'suppliers',
                'customers',
                'totalPurchese',
                'totalPurcheseCost',
                'totalPaid',
                'totalSale',
                'totalSaleAmount',
                'totalPaymentReceived',
              
            )
        );
    }


    public function edit(User $user)
    {
        $this->authorize('is_admin');
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('is_admin');
        $user->update($request->validated());
        return \redirect()->route('admin.users.index')->with(['status' => 'User updated successfully']);
    }


    public function destroy(User $user)
    {
        $this->authorize('is_admin');
        $user->delete();
        return redirect()->route('admin.users.index')->with(['status' => 'User deleted successfully']);
    }

    public function supplierPurchese($user_id, $supplier_id)
    {

        $this->authorize('is_admin');
        $supplier = DB::table('suppliers')->where('id', $supplier_id)->first();

        $purcheses = DB::table('purcheses')->where('supplier_id', $supplier_id)->paginate(10);
        $user = DB::table('users')->where('id', $user_id)->first();
        return view('users.supplierpurchese', compact('purcheses', 'supplier', 'user'));
    }


    public function purchesePayment($user_id, $purchese_id)
    {
        $this->authorize('is_admin');
        $payments = DB::table('payments')->where('purchese_id', $purchese_id)->paginate();
        $user = DB::table('users')->where('id', $user_id)->first();
        return view('users.purchesePayment', compact('payments', 'user'));
    }

    public function customerSale($user_id, $customer_id)
    {

        $customer = DB::table('customers')->where('id', $customer_id)->first();
        $user = DB::table('users')->where('id', $user_id)->first();
        $sales = DB::table('sales')->where('customer_id', $customer_id)->paginate(10);
        return view('users.customerSales', compact('sales', 'customer', 'user'));
    }


    public function salePayment($user_id, $sale_id)
    {
        $this->authorize('is_admin');
        $sale_payments = DB::table('sale_payments')->where('sale_id', $sale_id)->paginate();
        $user = DB::table('users')->where('id', $user_id)->first();
        return view('users.salePayment', compact('sale_payments', 'user'));
    }
}
