<?php
namespace App\Models;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Supplier;
use App\Traits\Currency;
use App\Traits\CreateFilter;
use App\Traits\NepaliDates;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchese extends Model
{
    use HasFactory, CreateFilter, SoftDeletes,Currency,NepaliDates;

    //use HasUuids,
    const UPDATED_AT = NULL;
    protected $fillable =
    [
        'weight',
        'rate',
        'user_id',
        'total','status', 'fy','supplier_id'
    ];

  
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected function createdDiff(): Attribute
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
    public function purchesesDue()
    {
        $totalCost = $this->total;
        $paid = $this->payments()->sum('amount');
        return $totalCost - $paid;
    }

   


   

   
}



