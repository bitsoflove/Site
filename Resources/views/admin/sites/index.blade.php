@extends('site::partials.fields.layouts.index', [
    'title' => trans('site::sites.title.sites'),
    'breadcrumbs' => [
        [
            'title' => trans('core::core.breadcrumb.home'),
            'href' => route('dashboard.index'),
            'icon' => 'fa-dashboard',
            'class' => '',
        ], [
            'title' => trans('site::sites.title.sites'),
            'href' => '',
            'icon' => '',
            'class' => 'active',
        ],
    ],

    'create' => [
       'route' => route('admin.site.site.create'),
       'title' => trans('site::sites.button.create site'),
    ],

    'collection' => [
        'collection' => $sites,
        'edit-href' => 'admin.site.site.edit',
        'delete-href' => 'admin.site.site.destroy'
    ],
    'table' => [
        'columns' => [
            //'id' => 'ID',
            'slug' => 'Slug',
            'title' => 'Title',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
        'classes' => [
            'created_at' => 'wrap',
            'updated_at' => 'wrap',
        ]
    ],
    'actions' => [
        'view' => false,
        'edit' => true,
        'delete' => true,
    ],
])
