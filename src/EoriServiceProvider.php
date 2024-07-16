<?php

namespace Slimad\Eori;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Slimad\Eori\Eori\Validator as EoriValidatorClient;
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
            $rule = new Eori($this->app->get(EoriValidator::class));
            $rule->validate($attribute, $value, static fn (?string $message = null) => null);

        });
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/eori.php', 'eori'
        );

        $this->app->singleton(EoriValidatorService::class, function (Container $app) {
            return new EoriValidatorService(new EoriValidatorClient());
        });
    }
}
