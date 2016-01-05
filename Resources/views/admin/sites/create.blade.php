@include('site::admin.sites.partials.create-or-edit', [
    'operation' => 'create',
    'cta' => 'create',
    'route' => 'store',
    'method' => 'POST',
    'model' => new App\Models\Site(),
])
