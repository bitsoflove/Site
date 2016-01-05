@include('fields::text', [
    'title' => 'Slug',
    'name' => 'slug',
    'placeholder' => 'slug',
    'value' => $model->slug,
])

@include('fields::checkbox', [
    'title' => 'Enabled',
    'name' => 'enabled',
    'checked' => !empty($model->enabled),
])
