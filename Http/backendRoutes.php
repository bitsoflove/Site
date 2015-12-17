<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/site'], function (Router $router) {

    get('current/{id}', ['as' => 'admin.site.site.current', 'uses' => 'SiteController@set']);

    $router->bind('sitelocales', function ($id) {
        return app('Modules\Site\Repositories\SiteLocaleRepository')->find($id);
    });
    get('sitelocales', ['as' => 'admin.site.sitelocale.index', 'uses' => 'SiteLocaleController@index']);
    get('sitelocales/create', ['as' => 'admin.site.sitelocale.create', 'uses' => 'SiteLocaleController@create']);
    post('sitelocales', ['as' => 'admin.site.sitelocale.store', 'uses' => 'SiteLocaleController@store']);
    get('sitelocales/{sitelocales}/edit', ['as' => 'admin.site.sitelocale.edit', 'uses' => 'SiteLocaleController@edit']);
    put('sitelocales/{sitelocales}/edit', ['as' => 'admin.site.sitelocale.update', 'uses' => 'SiteLocaleController@update']);
    delete('sitelocales/{sitelocales}', ['as' => 'admin.site.sitelocale.destroy', 'uses' => 'SiteLocaleController@destroy']);
    $router->bind('sites', function ($id) {
        return app('Modules\Site\Repositories\SiteRepository')->find($id);
    });
    get('sites', ['as' => 'admin.site.site.index', 'uses' => 'SiteController@index']);
    get('sites/create', ['as' => 'admin.site.site.create', 'uses' => 'SiteController@create']);
    post('sites', ['as' => 'admin.site.site.store', 'uses' => 'SiteController@store']);
    get('sites/{sites}/edit', ['as' => 'admin.site.site.edit', 'uses' => 'SiteController@edit']);
    put('sites/{sites}/edit', ['as' => 'admin.site.site.update', 'uses' => 'SiteController@update']);
    delete('sites/{sites}', ['as' => 'admin.site.site.destroy', 'uses' => 'SiteController@destroy']);



// append


});
