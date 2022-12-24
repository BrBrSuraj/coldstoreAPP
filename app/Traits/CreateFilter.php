<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;

trait CreateFilter
{

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->id();
            $model->fy = $model->getFy();
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
                $builder->where('user_id', auth()->id())->where('fy', $model->getFy())->where('deleted_at', null)->latest('id');
            }
        });
    }
}
