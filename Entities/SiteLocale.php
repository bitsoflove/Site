<?php namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Site\Entities\Site;

class SiteLocale extends Model
{

    /**
     * Generated
     */

    protected $table = 'site_locales';
    protected $fillable = [
        'id',
        'site_id',
        'locale_id',
        'locale',
        'title',
        'url',
        'description',
        'logo',
        'theme',
        'google_analytics_code',
        'created_at',
        'updated_at',
        'deleted_at',
        'contact_name',
        'contact_email'
    ];


    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }

    public function getDomainUrl()
    {
        $domainUrl = starts_with($this->url, 'http') ? $this->url : "http://" . $this->url;
        return $domainUrl;
    }


}