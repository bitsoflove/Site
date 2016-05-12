<?php $hasActions = !empty($actions['view'] || !empty($actions['edit']) || !empty($actions['delete'])); ?>

<table class="data-table table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width:75px;">ID</th>
        @foreach($table['columns'] as $columnKey => $columnName)
            <th class="@if(isset($table['classes'][$columnKey])){{$table['classes'][$columnKey]}}@endif" data-key="{{$columnKey}}">{{$columnName}}</th>
        @endforeach

        @if($hasActions)
            <th style="width:100px;" data-sortable="false">{{ trans('core::core.table.actions') }}</th>
        @endif
    </tr>
    </thead>
    <tbody>

    <?php if (isset($collection['collection'])): ?>
        <?php foreach ($collection['collection'] as $model): ?>
            <?php
                //the default href is the edit href
                $defaultHref = isset($collection['edit-href']) ? route($collection['edit-href'], [$model->id] ) : null;

                //..unless otherwise specified
                $defaultHref = isset($actions['default']) ? isset($collection[$actions['default'] . '-href']) ? route($collection[$actions['default'] . '-href'], [$model->id] ) : null : $defaultHref;
            ?>
            <tr>
                <td>{{$model->id}}</td>
                @foreach($table['columns'] as $columnKey => $columnName)
                    <td class="@if(isset($table['classes'][$columnKey])){{$table['classes'][$columnKey]}}@endif">

                        @if(empty($defaultHref))
                            <span>
                                <?=$model->$columnKey?>
                            </span>
                        @else
                            <a href="{{$defaultHref}}">
                                <?=$model->$columnKey?>
                            </a>
                        @endif
                    </td>
                @endforeach

                @if($hasActions)
                    <td>
                        <div class="btn-group">

                            @if(!empty($actions['view']))
                                <a href="{{ route($collection['view-href'], [$model->id]) }}" class="btn btn-default btn-flat">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif

                            @if(!empty($actions['edit']))
                                <a href="{{ route($collection['edit-href'], [$model->id]) }}" class="btn btn-default btn-flat">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            @endif

                            @if(!empty($actions['delete']))
                                <a href="#" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route($collection['delete-href'], [$model->id]) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                @endif
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
