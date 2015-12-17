<?php namespace Modules\Site\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Models\SiteLocale;
use Modules\Site\Repositories\SiteLocaleRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class SiteLocaleController extends AdminBaseController
{
    /**
     * @var SiteLocaleRepository
     */
    private $sitelocale;

    public function __construct(SiteLocaleRepository $sitelocale)
    {
        parent::__construct();

        $this->sitelocale = $sitelocale;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sitelocales = $this->sitelocale->all();

        return view('site::admin.sitelocales.index', compact('sitelocales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('site::admin.sitelocales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->sitelocale->create($request->all());

        flash()->success(trans('core::core.messages.resource created', ['name' => trans('site::sitelocales.title.sitelocales')]));

        return redirect()->route('admin.site.sitelocale.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SiteLocale $sitelocale
     * @return Response
     */
    public function edit(SiteLocale $sitelocale)
    {
        return view('site::admin.sitelocales.edit', compact('sitelocale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SiteLocale $sitelocale
     * @param  Request $request
     * @return Response
     */
    public function update(SiteLocale $sitelocale, Request $request)
    {
        $this->sitelocale->update($sitelocale, $request->all());

        flash()->success(trans('core::core.messages.resource updated', ['name' => trans('site::sitelocales.title.sitelocales')]));

        return redirect()->route('admin.site.sitelocale.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SiteLocale $sitelocale
     * @return Response
     */
    public function destroy(SiteLocale $sitelocale)
    {
        $this->sitelocale->destroy($sitelocale);

        flash()->success(trans('core::core.messages.resource deleted', ['name' => trans('site::sitelocales.title.sitelocales')]));

        return redirect()->route('admin.site.sitelocale.index');
    }
}
