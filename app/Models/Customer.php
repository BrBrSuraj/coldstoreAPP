<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\NepaliDates;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes,NepaliDates;
    //use HasUuids
    const UPDATED_AT = NULL;

    protected $fillable =
    [
        'name',
        'phone',
        'address', 
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->id();
        });

        self::addGlobalScope(function (Builder $builder) {
            if (
                request()->routeIs('system.purcheseReports.index')
                || (request()->routeIs('system.purcheseReports.show'))
                || (request()->routeIs('system.salesReports.index'))
                || (request()->routeIs('system.salesReports.show'))
                || (request()->routeIs('system.purcheseReports/payment'))
                || (request()->routeIs('system.salesReports/payment'))
                || (request()->routeIs('dashboard'))
            ) {
                $builder->where('deleted_at', null)->latest('id');
            } else {
                $model = $builder->getModel();
                $builder->where('user_id', auth()->id())->where('deleted_at', null)->latest('id');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function sale_payments()
    {
        return $this->hasManyThrough(SalePayment::class, Sale::class);
    }

    public function customerDue()
    {
        $totalsales = $this->sales()->sum('total');
        $totalPaid = $this->sale_payments()->sum('amount');
        return $totalsales - $totalPaid . " " . "rs";
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => ucfirst($value),
            set: fn ($value) => Carbon::create($this->nepaliDate()),
        );
    }
}
