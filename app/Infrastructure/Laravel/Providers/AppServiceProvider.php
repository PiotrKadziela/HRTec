<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Domain\CsvHelperInterface;
use App\Domain\DataBuilderInterface;
use App\Domain\RssFeedDataProviderInterface;
use App\Infrastructure\CsvHelper;
use App\Infrastructure\DataBuilder;
use App\Infrastructure\RssFeedDataProvider;
use Illuminate\Support\ServiceProvider;
use Vedmant\FeedReader\FeedReader;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RssFeedDataProviderInterface::class, function ($app) {
            return new RssFeedDataProvider(new FeedReader(app()));
        });
        $this->app->bind(CsvHelperInterface::class, function ($app) {
            return new CsvHelper();
        });
        $this->app->bind(DataBuilderInterface::class, function ($app) {
            return new DataBuilder();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
