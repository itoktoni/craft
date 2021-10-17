<?php

namespace Modules\Transaction\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;
use Modules\Transaction\Dao\Models\Monitoring;
use Modules\Transaction\Dao\Models\MovementDetail;
use Modules\Transaction\Dao\Models\SoDetail;
use Modules\Transaction\Dao\Models\WoDetail;
use Modules\Transaction\Dao\Repositories\BranchRepository;
use Modules\Transaction\Dao\Repositories\MovementRepository;
use Modules\Transaction\Dao\Repositories\SoRepository;
use Modules\Transaction\Dao\Repositories\StockRepository;
use Modules\Transaction\Dao\Repositories\SupplierRepository;
use Modules\Transaction\Dao\Repositories\WoRepository;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        
        $this->app->bind('so_facades', function () {
            return new SoRepository();
        });
        $this->app->bind('so_detail_facades', function () {
            return new SoDetail();
        });
        $this->app->bind('monitoring_facades', function () {
            return new Monitoring();
        });
        $this->app->bind('wo_facades', function () {
            return new WoRepository();
        });
        $this->app->bind('wo_detail_facades', function () {
            return new WoDetail();
        });
        $this->app->bind('movement_facades', function () {
            return new MovementRepository();
        });
        $this->app->bind('movement_detail_facades', function () {
            return new MovementDetail();
        });
        $this->app->bind('stock_facades', function () {
            return new StockRepository();
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('Transaction.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'Transaction'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/Transaction');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/Transaction';
        }, Config::get('view.paths')), [$sourcePath]), 'Transaction');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/Transaction');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'Transaction');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'Transaction');
        }
    }

    /**
     * Register an additional directory of Repositories.
     *
     * @return void
     */
    public function registerFactories()
    {
        // if (! app()->environment('production')) {
        //     app(Factory::class)->load(__DIR__ . '/../Database/factories');
        // }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
