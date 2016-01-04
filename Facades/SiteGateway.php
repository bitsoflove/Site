<?php

namespace Modules\Site\Facades;

use App\Models\SiteLocale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SiteGateway {
    public function id() {

        //1. get current host
        $host = $this->host();

        //2. see if we already know the site ID from this host in the cache
        $cacheKey = 'site_' . $host;
        $siteId = Cache::get($cacheKey);

        //3. if we couldn't find an entry in the cache, find the site ID via the database
        if(empty($siteId)) {
            $siteId = $this->getSiteIdFromDatabase($host);
        }

        //4. throw an exception if we couldn't find the site ID in the database
        if(empty($siteId)) {
            $error = 'Host was not defined as a site on the database level: ' . $host;
            throw new \Exception($error);
        }

        //5. Keep the siteId in the cache!
        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put($cacheKey, $siteId, $expiresAt);
        return $siteId;
    }

    public function host() {
        return isset($_SERVER['HTTPS_HOST']) ? $_SERVER['HTTPS_HOST'] : $_SERVER['HTTP_HOST'];
    }

    private function getSiteIdFromDatabase($host) {
        $siteLocale = SiteLocale::where('url', '=', $host)->first();
        $siteId = empty($siteLocale) ? null :  $siteLocale->site_id;
        return $siteId;
    }
}