<?php

namespace Modules\Popup\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Page\Composers\TemplateViewComposer;
use Modules\Popup\Events\Handlers\RegisterPopupSidebar;

class PopupServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        \Widget::register('popup', '\Modules\Popup\Widgets\PopupWidget@popup');

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('Popup', RegisterPopupSidebar::class)
        );

        $this->app->extend('asgard.ModulesList', function($app) {
            array_push($app, 'popup');
            return $app;
        });

        view()->composer(['popup::admin.popups.create', 'popup::admin.popups.edit'], TemplateViewComposer::class);
    }

    public function boot()
    {
        $this->publishConfig('popup', 'config');
        $this->publishConfig('popup', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Popup\Repositories\PopupRepository',
            function () {
                $repository = new \Modules\Popup\Repositories\Eloquent\EloquentPopupRepository(new \Modules\Popup\Entities\Popup());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Popup\Repositories\Cache\CachePopupDecorator($repository);
            }
        );
// add bindings

    }
}
