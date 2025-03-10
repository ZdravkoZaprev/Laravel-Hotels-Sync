<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\ParserFactory;
use App\Services\CsvParser;
use App\Services\JsonParser;

class ParserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(ParserFactory::class, function ($app) {
            return new ParserFactory([
                'csv' => $app->make(CsvParser::class),
                'json' => $app->make(JsonParser::class)
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}
