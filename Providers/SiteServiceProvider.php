<?php namespace Modules\Site\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Site\Entities\Site;
use Modules\Site\Entities\SiteLocale;
use Modules\Site\Facades\SiteGateway;
use Modules\Site\Repositories\Cache\CacheSiteDecorator;
use Modules\Site\Repositories\Cache\CacheSiteLocaleDecorator;
use Modules\Site\Repositories\Eloquent\EloquentSiteLocaleRepository;
use Modules\Site\Repositories\Eloquent\EloquentSiteRepository;

class SiteServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    public function boot(){
        $this->publishes([
            __DIR__ . '/../Resources/views' => base_path('resources/views/asgard/site'),
        ]);
        
        $this->loadViewsFrom(base_path('resources/views/asgard/site'), 'site');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'site');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
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
        //the multi site tenancy facade
        $this->app->bind(
            'site',
            function () {
                return new SiteGateway;
            }
        );

        $this->app->bind(
            'Modules\Site\Repositories\SiteLocaleRepository',
            function () {
                $repository = new EloquentSiteLocaleRepository(new SiteLocale());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new CacheSiteLocaleDecorator($repository);
            }
        );


        $this->app->bind(
            'Modules\Site\Repositories\SiteRepository',
            function () {
                $repository = new EloquentSiteRepository(new Site());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new CacheSiteDecorator($repository);
            }
        );



// add bindings


    }
}
