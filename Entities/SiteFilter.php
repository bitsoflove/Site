<?php namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Site\Entities\Filter;
use Modules\Site\Entities\Site;

class SiteFilter extends Model
{
    /**
     * @var string
     */
    protected $table = 'filter_site';
    
    /**
     * @var array
     */
    protected $fillable = [
        'site_id',
        'filter_id'
    ];

    /**
     * @return BelongsTo
     */
    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }

}