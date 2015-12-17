<?php namespace Modules\Site\Providers;

use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
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
            'Modules\Site\Repositories\SiteLocaleRepository',
            function () {
                $repository = new \Modules\Site\Repositories\Eloquent\EloquentSiteLocaleRepository(new \App\Models\SiteLocale());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Site\Repositories\Cache\CacheSiteLocaleDecorator($repository);
            }
        );


        $this->app->bind(
            'Modules\Site\Repositories\SiteRepository',
            function () {
                $repository = new \Modules\Site\Repositories\Eloquent\EloquentSiteRepository(new \App\Models\Site());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Site\Repositories\Cache\CacheSiteDecorator($repository);
            }
        );

// add bindings


    }
}
