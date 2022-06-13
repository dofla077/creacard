<?php

namespace App\Providers;

use App\Contracts\CustomersService;
use App\Contracts\QuotationsService;
use App\Services\CustomerService;
use App\Services\QuotationService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CustomersService::class, function () {
            return new CustomerService();
        });

        $this->app->bind(QuotationsService::class, function () {
            return new QuotationService();
        });
    }
}
