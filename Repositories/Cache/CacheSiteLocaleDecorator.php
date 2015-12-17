<?php namespace Modules\Site\Repositories\Cache;

use Modules\Site\Repositories\SiteLocaleRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheSiteLocaleDecorator extends BaseCacheDecorator implements SiteLocaleRepository
{
    public function __construct(SiteLocaleRepository $sitelocale)
    {
        parent::__construct();
        $this->entityName = 'site.sitelocales';
        $this->repository = $sitelocale;
    }
}
