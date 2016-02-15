@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans("site::sites.title.$operation site") }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.site.site.index') }}">{{ trans('site::sites.title.sites') }}</a></li>
        <li class="active">{{ trans("site::sites.title.$operation site") }}</li>
    </ol>
@stop

@section('styles')
    {!! Theme::script('js/vendor/ckeditor/ckeditor.js') !!}
    {!! Theme::style('css/vendor/iCheck/flat/blue.css') !!}
@stop

@section('content')

    <?php
        if(!isset($supportedLocales)) {
            $supportedLocales = LaravelLocalization::getSupportedLocales();
        }
        if(!isset($activeLocale)) {
            $allLocales = array_keys($supportedLocales);
            $activeLocale = $allLocales[0];
        }
    ?>

    {!! Form::open(['route' => ["admin.site.site.$route", $model->id], 'method' => "$method"]) !!}
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('core::core.title.translatable fields') }}</h3>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        @include('partials.form-tab-headers', ['locales' => $supportedLocales, 'activeLocale' => $activeLocale])
                        <div class="tab-content">
                            <?php $i = 0; ?>
                                @foreach ($supportedLocales as $locale => $language)
                                <?php $i++; ?>
                                <div class="tab-pane {{ $activeLocale == $locale ? 'active' : '' }}" id="tab_{{ $locale }}">
                                    @include('site::admin.sites.partials.fields-translatable', ['lang' => $locale, 'model' => $model])

                                    {{--see resources/views/admin/site--}}
                                    @include('admin.site.create-or-edit-extra-fields-translatable', ['lang' => $locale, 'model' => $model])
                                </div>
                            @endforeach
                        </div>
                    </div> {{-- end nav-tabs-custom --}}
                </div>
            </div>


            <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('core::core.title.non translatable fields') }}</h3>
                    </div>
                    <div class="box-body">
                        @include('site::admin.sites.partials.fields-non-translatable', ['lang' => $locale, 'model' => $model ])
                        @include('admin.site.create-or-edit-extra-fields-non-translatable', ['lang' => $locale, 'model' => $model])
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans("core::core.button.$cta") }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.menu.menu.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                </div>
            </div>

        </div>
    </div>

    {!! Form::close() !!}
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

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.site.site.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[type="checkbox"]').on('ifChecked', function(){
                $(this).parent().find('input[type=hidden]').remove();
            });

            $('input[type="checkbox"]').on('ifUnchecked', function(){
                var name = $(this).attr('name'),
                    input = '<input type="hidden" name="' + name + '" value="0" />';
                $(this).parent().append(input);
            });
        });
    </script>
@stop
