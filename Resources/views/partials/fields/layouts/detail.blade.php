@extends('layouts.master')

@section('content-header')
    <h1>
        {{$title}}
    </h1>

    @include('fields::layouts.partials.breadcrumbs', compact('breadcrumbs'))
@stop

@section('styles')
    {!! Theme::style('css/vendor/iCheck/flat/blue.css') !!}
@stop



@section('content')
    @yield('content')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop
