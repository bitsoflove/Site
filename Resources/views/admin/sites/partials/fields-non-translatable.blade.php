@include('site::partials.fields.text', [
    'title' => 'Slug',
    'name' => 'slug',
    'placeholder' => 'slug',
    'value' => $model->slug,
])

@include('site::partials.fields.checkbox', [
    'title' => 'Enabled',
    'name' => 'enabled',
    'checked' => !empty($model->enabled),
])
