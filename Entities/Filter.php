<?php namespace Modules\Site\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Site\Entities\Site;

class Filter extends Model
{
    /**
     * @var string
     */
    protected $table = 'filters';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'slug',
        'name'
    ];

    /**
     * @return BelongsToMany
     */
    public function sites()
    {
        return $this->belongsToMany(Site::class, 'filter_site', 'filter_id', 'site_id');
    }

    /**
     * @return HasMany
     */
    public function siteFilters()
    {
        return $this->hasMany(SiteFilter::class, 'filter_id', 'id');
    }


}