
@include('site::admin.sites.partials.create-or-edit', [
    'operation' => 'edit',
    'cta' => 'update',
    'route' => 'update',
    'method' => 'PUT',
    'model' => $site,
    'supportedLocales' => $site->siteLocales->lists('title', 'locale')->toArray(),
])
