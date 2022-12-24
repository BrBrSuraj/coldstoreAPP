<?php

namespace App\Models;


use Carbon\Carbon;
use App\Models\Customer;
use App\Traits\Currency;
use App\Models\SalePayment;
use App\Traits\NepaliDates;
use App\Traits\CreateFilter;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, CreateFilter, SoftDeletes, Currency,NepaliDates;

    //use HasUuids,
    const UPDATED_AT = NULL;
    protected $fillable =
    [
        'weight',
        'rate',
        'user_id',
        'total',
        'status', 'fy'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sale_payments()
    {
        return $this->hasMany(SalePayment::class);
    }


    public function saleDue()
    {
        $totalCost = $this->total;
        $paid = $this->sale_payments()->sum('amount');
        return $totalCost - $paid;
    }


   
    public function createdDiff(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->format('Y/m/d'),

        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => ucfirst($value),
            set: fn ($value) => Carbon::create($this->nepaliDate()),
        );
    }

    public function formatedWeight(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->weight . " " . "kg"

        );
    }

    public function formatedRate(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->currency($this->rate),

        );
    }


    public function formatedTotal(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->currency($this->total),

        );
    }
}
