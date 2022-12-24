<?php

namespace App\Models;


use Carbon\Carbon;
use App\Models\Purchese;
use App\Traits\Currency;
use App\Traits\NepaliDates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, SoftDeletes, Currency,NepaliDates;
    //use  HasUuids, 
    const UPDATED_AT = NULL;

    
    protected $fillable =
    [
        'amount',
        'purchese_id',
        'user_id', 'fy'
       
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->id();
            $model->fy = $model->getFy();
        });

        self::addGlobalScope(function (Builder $builder) {
            $builder->latest('id');
        });
    }

    public function purchese()
    {
        return $this->belongsTo(Purchese::class);
    }

   



    public function createdDiff(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->format('Y/m/d'),

        );
    }

    public function formatedAmount(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->currency($this->amount),

        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => ucfirst($value),
            set: fn ($value) => Carbon::create($this->nepaliDate()),
        );
    }

}
