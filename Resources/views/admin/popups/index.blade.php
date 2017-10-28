@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('popup::popups.title.popups') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('popup::popups.title.popups') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.popup.popup.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('popup::popups.button.create popup') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('popup::popups.form.title') }}</th>
                            <th>{{ trans('popup::popups.form.design_type') }}</th>
                            <th>{{ trans('popup::popups.form.template') }}</th>
                            <th>{{ trans('popup::popups.form.start_at').'/'.trans('popup::popups.form.end_at') }}</th>
                            <th>{{ trans('popup::popups.form.start_hour').'/'.trans('popup::popups.form.end_hour') }}</th>
                            <th>{{ trans('popup::popups.form.settings.width').'/'.trans('popup::popups.form.settings.height') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($popups)): ?>
                        <?php foreach ($popups as $popup): ?>
                        <tr>
                            <td>
                                {{ $popup->id }}
                            </td>
                            <td>
                                <a href="{{ route('admin.popup.popup.edit', [$popup->id]) }}">
                                    {{ $popup->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.popup.popup.edit', [$popup->id]) }}">
                                    {{ $popup->design_type }}
                                </a>
                            </td>
                            <td>
                                {{ $popup->template }}
                            </td>
                            <td>
                                {{ $popup->start_at->format('d.m.Y').'/'.$popup->end_at->format('d.m.Y') }}
                            </td>
                            <td>
                                {{ $popup->start_hour.'/'.$popup->end_hour }}
                            </td>
                            <td>
                                {{ $popup->settings->width.'x'.$popup->settings->height }}
                            </td>
                            <td>
                                <a href="{{ route('admin.popup.popup.edit', [$popup->id]) }}">
                                    {{ $popup->created_at }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.popup.popup.edit', [$popup->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.popup.popup.destroy', [$popup->id]) }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- /.box-body -->
                    </div>
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
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('popup::popups.title.create popup') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.popup.popup.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
