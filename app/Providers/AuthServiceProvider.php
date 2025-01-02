<?php

namespace App\Providers;

use App\Models\Prescription;
use App\Models\Quotation;
use App\Policies\PrescriptionPolicy;
use App\Policies\QuotationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        Prescription::class => PrescriptionPolicy::class,
        Quotation::class => QuotationPolicy::class,
    ];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
