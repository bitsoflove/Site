<?php

namespace Modules\Site\Facades;

use Modules\Site\Entities\SiteLocale;
use Modules\Site\Entities\Site;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SiteGateway {

    public function setLocale() {
        $locale = $this->getLocale();
        \App::setLocale($locale);
        \App('laravellocalization')->setLocale($locale);
    }

    public function all() {
        return Site::all();
    }

    public function id() {
        if(app()->runningInConsole()) {
            return null;
        }

        //1. get current host
        $host = $this->host(true);

        //2. see if we already know the site ID from this host in the cache
        $cacheKey = 'site_id_' . $host;
        $siteId = Cache::get($cacheKey);

        //3. if we couldn't find an entry in the cache, find the site ID via the database
        if(empty($siteId)) {
            $siteId = $this->getSiteIdFromDatabase($host);
        }

        //4. throw an exception if we couldn't find the site ID in the database
        if(empty($siteId) && !\App::runningInConsole()) {
            $error = 'Host was not defined as a site on the database level: ' . $host;
            throw new \Exception($error);
        }

        //5. Keep the siteId in the cache!
        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put($cacheKey, $siteId, $expiresAt);
        return $siteId;
    }

    public function current() {
        if(app()->runningInConsole()) {
            return null;
        }

        $id = $this->id();

        $cacheKey = 'site_current_' . $id;
        $site = Cache::get($cacheKey);

        if(empty($site)) {
            $site = Site::where('id', $id)->first();
        }

        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put($cacheKey, $site, $expiresAt);
        return $site;
    }

    public function currentLocale() {
        if(app()->runningInConsole()) {
            return null;
        }

        $id = $this->id();
        $host = $this->host(true);

        $cacheKey = 'site_currentLocale_' . $id . '_' . $host;
        $currentLocale = Cache::get($cacheKey);

        if(empty($currentLocale)) {
            $site = $this->current();

            $this->setLocale();
            $locale = \App('laravellocalization')->getCurrentLocale();
            $currentLocale = $site->siteLocales()->where('locale', $locale)->where('url', 'LIKE', '%' . $host) ->first();
        }

        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put($cacheKey, $currentLocale, $expiresAt);
        return $currentLocale;
    }

    public function host($removeWww=false) {
        $fullHost = isset($_SERVER['HTTPS_HOST']) ? $_SERVER['HTTPS_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;

        //remove port from host (on testing environments, the host will contain the port, removing this would make the tests fail)
        $split = explode(':', $fullHost);
        $host = $split[0];


        if($removeWww) {
            $host = $this->removePrefix($host, 'www.');
        }

        return $host;
    }

    public function locales() {
        $currentSite = $this->current();
        $locales = [];
        foreach($currentSite->siteLocales as $locale) {
            $loc = $locale->locale;
            $locales[$loc] = $loc;
        }
        return $locales;
    }

    private function getSiteIdFromDatabase($host) {

        $siteLocale = SiteLocale::where('url', 'LIKE', '%' .  $host)->first();
        $siteId = empty($siteLocale) ? null :  $siteLocale->site_id;
        return $siteId;
    }

    private function getLocale() {
        if(app()->runningInConsole()) {
            return null;
        }

        $host = \Site::host(true);
        $cacheKey = 'site_locale_' . $host;

        $locale = Cache::get($cacheKey);

        if(empty($locale)) {
            $siteLocale = SiteLocale::where('url', 'LIKE', '%' .  $host)->first();

            if(empty($siteLocale)) {
                $error = 'No SiteLocale defined on the database level for host ' . $host;
                throw new \Exception($error);
            }

            $locale = $siteLocale->locale;
        }

        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put($cacheKey, $locale, $expiresAt);
        return $locale;
      }


    private function removePrefix($str, $prefix) {
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            $str = substr($str, strlen($prefix));
        }
        return $str;
    }



}
