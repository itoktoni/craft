<?php

namespace Modules\Master\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;
use Modules\Master\Dao\Models\LinenDetail;

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
        $this->app->bind('category_facades', function () {
            return new \Modules\Master\Dao\Repositories\CategoryRepository();
        });
        $this->app->bind('product_facades', function () {
            return new \Modules\Master\Dao\Repositories\ProductRepository();
        });
        $this->app->bind('unit_facades', function () {
            return new \Modules\Master\Dao\Repositories\UnitRepository();
        });
        $this->app->bind('bank_facades', function () {
            return new \Modules\Master\Dao\Repositories\BankRepository();
        });
        $this->app->bind('converter_facades', function () {
            return new \Modules\Master\Dao\Repositories\ConverterRepository();
        });
        $this->app->bind('supplier_facades', function () {
            return new \Modules\Master\Dao\Repositories\SupplierRepository();
        });
        $this->app->bind('location_facades', function () {
            return new \Modules\Master\Dao\Repositories\LocationRepository();
        });
        $this->app->bind('material_facades', function () {
            return new \Modules\Master\Dao\Repositories\MaterialRepository();
        });
        $this->app->bind('tax_facades', function () {
            return new \Modules\Master\Dao\Repositories\TaxRepository();
        });
        $this->app->bind('trucking_facades', function () {
            return new \Modules\Master\Dao\Repositories\TruckingRepository();
        });
        $this->app->bind('vehicle_facades', function () {
            return new \Modules\Master\Dao\Repositories\VehicleRepository();
        });
        $this->app->bind('warehouse_facades', function () {
            return new \Modules\Master\Dao\Repositories\WarehouseRepository();
        });
        $this->app->bind('payment_facades', function () {
            return new \Modules\Master\Dao\Repositories\PaymentRepository();
        });
        $this->app->bind('service_facades', function () {
            return new \Modules\Master\Dao\Repositories\ServiceRepository();
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
            __DIR__.'/../Config/config.php' => config_path('Master.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'Master'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/Master');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/Master';
        }, Config::get('view.paths')), [$sourcePath]), 'Master');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/Master');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'Master');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'Master');
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
