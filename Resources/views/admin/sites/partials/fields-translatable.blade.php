@include('fields::text', [
    'title' => 'Title',
    'name' => $locale . '[title]',
    'placeholder' => 'title',
    'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->title,
])

@include('fields::text', [
    'title' => 'URL',
    'name' => $locale . '[url]',
    'placeholder' => 'url',
    'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->url,
])

@include('fields::text', [
    'title' => 'Description',
    'name' => $locale . '[description]',
    'placeholder' => 'description',
    'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->description,
])

@include('fields::text', [
    'title' => 'Logo',
    'name' => $locale . '[logo]',
    'placeholder' => 'logo',
    'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->logo,
])

@include('fields::text', [
    'title' => 'Theme',
    'name' => $locale . '[theme]',
    'placeholder' => 'theme',
    'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->theme,
])

@include('fields::text', [
    'title' => 'Google Analytics Code',
    'name' => $locale . '[google_analytics_code]',
    'placeholder' => 'UA-XXXXXXXX',
    'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->google_analytics_code,
])
