<?php namespace Modules\Site\Repositories\Cache;

use Modules\Site\Repositories\SiteRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheSiteDecorator extends BaseCacheDecorator implements SiteRepository
{
    public function __construct(SiteRepository $site)
    {
        parent::__construct();
        $this->entityName = 'site.sites';
        $this->repository = $site;
    }
}
