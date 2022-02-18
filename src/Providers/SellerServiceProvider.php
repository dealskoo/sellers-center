<?php

namespace Dealskoo\Seller\Providers;

use Dealskoo\Admin\Facades\AdminMenu;
use Dealskoo\Admin\Facades\PermissionManager;
use Dealskoo\Admin\Permission;
use Dealskoo\Seller\Contracts\Dashboard;
use Dealskoo\Seller\Contracts\Searcher;
use Dealskoo\Seller\Contracts\Support\DefaultDashboard;
use Dealskoo\Seller\Contracts\Support\DefaultSearcher;
use Dealskoo\Seller\Contracts\Support\DefaultWelcome;
use Dealskoo\Seller\Contracts\Welcome;
use Dealskoo\Seller\Menu\SellerPresenter;
use Illuminate\Support\ServiceProvider;
use Nwidart\Menus\Facades\Menu;

class SellerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/seller.php', 'seller');
        $this->app->bind(Welcome::class, DefaultWelcome::class);
        $this->app->bind(Dashboard::class, DefaultDashboard::class);
        $this->app->bind(Searcher::class, DefaultSearcher::class);
        $this->app->singleton('seller_menu', function () {
            return Menu::instance('seller_navbar');
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);

            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/seller.php' => config_path('seller.php')
            ], 'config');

            $this->publishes([
                __DIR__ . '/../../public' => public_path('vendor/seller')
            ], 'public');

            $this->publishes([
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/seller'),
            ], 'lang');
        }

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'seller');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'seller');

        Menu::create('seller_navbar', function ($menu) {
            $menu->enableOrdering();
            $menu->setPresenter(SellerPresenter::class);
            $menu->route('seller.dashboard', 'seller::seller.dashboard', [], ['icon' => 'uil-dashboard me-1']);
        });

        AdminMenu::dropdown('seller::seller.sellers_management', function ($menu) {
            $menu->route('admin.sellers.index', 'seller::seller.sellers', [], ['permission' => 'sellers.index'])->order(1);
        }, ['icon' => 'uil-shop', 'permission' => 'sellers.management'])->order(5);

        PermissionManager::add(new Permission('sellers.management', 'Sellers Management'));
        PermissionManager::add(new Permission('sellers.index', 'Sellers List'), 'sellers.management');
        PermissionManager::add(new Permission('sellers.show', 'View Seller'), 'sellers.index');
        PermissionManager::add(new Permission('sellers.edit', 'Edit Seller'), 'sellers.index');
    }
}
