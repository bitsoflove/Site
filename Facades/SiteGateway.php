<?php

namespace Modules\Site\Facades;

use App\Models\SiteLocale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SiteGateway {

    public function setLocale() {
        $locale = $this->getLocale();
        \App::setLocale($locale);
        \App('laravellocalization')->setLocale($locale);
    }

    public function all() {
        return \App\Models\Site::all();
    }

    public function id() {
        if(app()->runningInConsole()) {
            return null;
        }

        //1. get current host
        $host = $this->host();

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
            $site = \App\Models\Site::where('id', $id)->first();
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
        $host = $this->host();

        $cacheKey = 'site_currentLocale_' . $id . '_' . $host;
        $currentLocale = Cache::get($cacheKey);

        if(empty($currentLocale)) {
            $site = $this->current();

            $this->setLocale();
            $locale = \App('laravellocalization')->getCurrentLocale();
            $currentLocale = $site->siteLocales()->where('locale', $locale)->first();
        }

        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put($cacheKey, $currentLocale, $expiresAt);
        return $currentLocale;
    }

    public function host() {
        $fullHost = isset($_SERVER['HTTPS_HOST']) ? $_SERVER['HTTPS_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;

        //remove port from host (on testing environments, the host will contain the port, removing this line would make the tests fail)
        $split = explode(':', $fullHost);

        $host = $split[0];
        return $host;
    }

    private function getSiteIdFromDatabase($host) {
        $siteLocale = SiteLocale::where('url', '=', $host)->first();
        $siteId = empty($siteLocale) ? null :  $siteLocale->site_id;
        return $siteId;
    }

    private function getLocale() {
        if(app()->runningInConsole()) {
            return null;
        }

        $host = \Site::host();
        $cacheKey = 'site_locale_' . $host;

        $locale = Cache::get($cacheKey);

        if(empty($locale)) {
            $siteLocale = \App\Models\SiteLocale::where('url', $host)->first();

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
}
