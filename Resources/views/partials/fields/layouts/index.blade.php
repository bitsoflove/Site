
@extends('layouts.master')

@section('content-header')
    <h1>
        {{$title}}
    </h1>
    @include('site::partials.fields.layouts.partials.breadcrumbs', compact('breadcrumbs'))
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                @if(isset($create))
                    <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                        <a href="{{ $create['route'] }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                            <i class="fa fa-pencil"></i> {{ $create['title'] }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('site::partials.fields.layouts.partials.table', compact('table', 'collection', 'actions'))
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    @if(isset($create))
        <dl class="dl-horizontal">
            <dt><code>c</code></dt>
            <dd>{{ $create['title'] }}</dd>
        </dl>
    @endif
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            @if(isset($create))
                $(document).keypressAction({
                    actions: [
                        { key: 'c', route: "<?= $create['route'] ?>" }
                    ]
                });
            @endif
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": <?= isset($table['paginate']) ? $table['paginate'] ? 'true'  : 'false' : 'true' ?>,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                //"order": [[ 0, "desc" ]],
                "order": [],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@stop
