<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Purchese;
use App\Traits\NepaliDates;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes, NepaliDates;
    //use HasUuids, 

    const UPDATED_AT = NULL;


    protected $fillable =
    [
        'name',
        'phone',
        'address'
    ];
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => ucfirst($value),
            set: fn ($value) => Carbon::create($this->nepaliDate()),
        );
    }



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
                $builder->where('deleted_at', null)->latest();
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

    public function purcheses()
    {
        return $this->hasMany(Purchese::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Purchese::class);
    }

    public function supplierDue()
    {
        $totalPurchese = $this->purcheses()->sum('total');
        $totalPaid = $this->payments()->sum('amount');
        return $totalPurchese - $totalPaid . " " . "rs";
    }
}
