<?php namespace Modules\Site\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Models\Site;
use Modules\Site\Repositories\SiteRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class SiteController extends AdminBaseController
{
    /**
     * @var SiteRepository
     */
    private $site;

    public function __construct(SiteRepository $site)
    {
        parent::__construct();

        $this->site = $site;
    }

    public function set($id) {

        $site = $this->site->find($id);
        if(empty($site)) {
            flash()->error('Could not change site, invalid ID!');
            return \Redirect::back();
        }

        $domain = $site->getSharedDomain();
        $siteLocale = $site->siteLocales()->where('url', 'LIKE', "%.$domain")->first();

        if(empty($siteLocale)) {
            throw new \Exception("Could not get siteLocale for site " . $site->slug . " LIKE %.$domain");
        }

        $url = 'http://' . $siteLocale->url . '/backend';//0 . $_GET['uri'];
        header("Location: $url");
        exit();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sites = $this->site->all();

        return view('site::admin.sites.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('site::admin.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->site->create($request->all());

        flash()->success(trans('core::core.messages.resource created', ['name' => trans('site::sites.title.sites')]));

        return redirect()->route('admin.site.site.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Site $site
     * @return Response
     */
    public function edit(Site $site)
    {
        $loc = $site->siteLocales->lists('title', 'locale')->toArray();
        return view('site::admin.sites.edit', [
            'site' => $site,
            'supportedLocales' => $loc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Site $site
     * @param  Request $request
     * @return Response
     */
    public function update(Site $site, Request $request)
    {
        $this->site->update($site, $request->all());

        flash()->success(trans('core::core.messages.resource updated', ['name' => trans('site::sites.title.sites')]));

        return redirect()->route('admin.site.site.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Site $site
     * @return Response
     */
    public function destroy(Site $site)
    {
        $this->site->destroy($site);

        flash()->success(trans('core::core.messages.resource deleted', ['name' => trans('site::sites.title.sites')]));

        return redirect()->route('admin.site.site.index');
    }
}
