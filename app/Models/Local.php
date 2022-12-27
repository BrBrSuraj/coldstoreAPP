<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Currency;
use App\Traits\NepaliDates;
use App\Traits\CreateFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Local extends Model
{
    use HasFactory, SoftDeletes, Currency, CreateFilter,NepaliDates;
    const UPDATED_AT = NULL;
    protected $fillable = ['remark', 'weight', 'rate', 'total', 'fy','credit'];

    protected function formatedWeight(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->weight . " " . "kg.",

        );
    }
    protected function formatedRate(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->currency($this->rate),

        );
    }


    protected function formatedTotal(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->currency($this->total),

        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            
            set: fn ($value) =>$this->nepaliDate(),
             get: fn ($value) =>Carbon::createFromDate($value)->format('Y/m/d') ,
        );
    }


}
