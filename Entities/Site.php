<?php namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Page\Entities\Page;
use Modules\Site\Entities\SiteLocale;
use Modules\Site\Entities\Filter;
use Modules\Site\Entities\SiteFilter;

class Site extends Model
{

    use Translatable;

    use SoftDeletes;


    /**
     * @var string
     */
    protected $table = 'sites';

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'url', 'description', 'logo', 'theme', 'google_analytics_code'];

    /**
     * @var array
     */
    protected $fillable = [
        'slug',
        'enabled',
        'has_public_table_of_contents',
        'has_public_search',
        'has_covers',
        'has_searchable_pdfs',
        'title',
        'url',
        'description',
        'logo',
        'theme',
        'google_analytics_code',
        'deleted_at',
        'contact_name',
        'contact_email'
    ];

    /**
     * @var string
     */
    public $translationModel = SiteLocale::class;

    /**
     * @var string
     */
    protected $with = 'filters';

    /**
     * @param string $locale
     * @return SiteLocale
     * @throws \Exception
     */
    public function getLocale($locale)
    {
        $domain = $this->getSharedDomain();
        $siteLocale = $this->siteLocales()->where('url', 'LIKE', "%.$domain")->where('locale', $locale)->first();
        return $siteLocale;
    }


    /**
     * Because every site has many locales, we might want to determine what the 'shared' domain is between locales
     *
     * eg some-site.development-asgard.be
     * shared domain = development-asgard.be
     *
     * eg some-site.be
     * shared domain = .be
     *
     * @return string
     * @throws \Exception
     */
    public function getSharedDomain()
    {
        //remove www prefix from current host if it exists
        $currentHost = \Site::host(true);

        //remove first subdomain
        $split = explode('.', $currentHost);
        $domain = implode('.', $split);

        if (empty($domain)) {
            throw new \Exception("Could not get shared domain from " . $currentHost);
        }

        return $domain;
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            config('cartalyst.sentinel.users.model', "App\\User"),
            'site_user',
            'site_id',
            'user_id');
    }

    /**
     * @return HasMany
     */
    public function siteLocales()
    {
        return $this->hasMany(SiteLocale::class, 'site_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'site_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'filter_site', 'site_id', 'filter_id');
    }

    /**
     * @return HasMany
     */
    public function siteFilters()
    {
        return $this->hasMany(SiteFilter::class, 'site_id', 'id');
    }

    /**
     * All the content of this site
     */
    public function getAllContentsAttribute()
    {
        $myContent = $this->contents->keyBy('id');
        return $myContent->keyBy('entityId');
    }

    /**
     * @param array $attributes
     * @return Site
     */
    public static function create(array $attributes = [])
    {
        $model = parent::create($attributes);
        $model->syncFilters($attributes);
        return $model;
    }

    /**
     * @param array $attributes
     * @return Site
     */
    public function update(array $attributes = [])
    {
        parent::update($attributes);
        $this->syncFilters($attributes);
        return $this;
    }

    /**
     * @param array $attributes
     */
    public function syncFilters($attributes)
    {
        if (isset($attributes['site_filter'])) {
            $siteFilters = $attributes['site_filter'];
            $this->filters()->sync($siteFilters);
        }
    }
}