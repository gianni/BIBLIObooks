<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class CustomValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('date_range_not_overlap', 'App\Rules\DateRangeNotOverlap@passes');
    }
}
