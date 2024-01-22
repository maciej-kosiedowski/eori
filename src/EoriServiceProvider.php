<?php

namespace Slimad\Eori;

use Davidvandertuijn\Eori\Validator as EoriValidatorClient;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Slimad\Eori\Rules\Eori;

class EoriServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->app->bind(EoriValidator::class, EoriValidatorService::class);

        /**
         * Register the "eori" validation rule.
         */
        Validator::extend('eori', function ($attribute, $value, $parameters, $validator) {
            return (new Eori($this->app->get(EoriValidator::class)))->passes($attribute, $value);
        }, (new Eori($this->app->get(EoriValidator::class)))->message());
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->singleton(EoriValidatorService::class, function (Container $app) {
            return new EoriValidatorService(new EoriValidatorClient());
        });
    }
}
