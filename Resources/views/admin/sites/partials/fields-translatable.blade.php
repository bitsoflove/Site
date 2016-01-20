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

<div class="row">
    <div class="col-xs-12 col-sm-6">
        @include('fields::text', [
            'title' => 'Contact name',
            'name' => $locale . '[contact_name]',
            'placeholder' => 'name',
            'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->contact_name,
        ])
    </div>
    <div class="col-xs-12 col-sm-6">
        @include('fields::text', [
            'title' => 'Contact e-mail',
            'name' => $locale . '[contact_email]',
            'placeholder' => 'e-mail',
            'value' => empty($model->translate($locale)) ? null : $model->translate($locale)->contact_email,
        ])
    </div>
</div>