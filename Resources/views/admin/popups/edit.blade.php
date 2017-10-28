@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('popup::popups.title.edit popup') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.popup.popup.index') }}">{{ trans('popup::popups.title.popups') }}</a></li>
        <li class="active">{{ trans('popup::popups.title.edit popup') }}</li>
    </ol>
@stop

@section('content')
    <div id="app">
    {!! Form::open(['route' => ['admin.popup.popup.update', $popup->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-body">
                        {!! Form::normalSelect('design_type', trans('popup::popups.form.design_type'), $errors, [
                        'image' => trans('popup::popups.select.design_type.image'),
                        'text' => trans('popup::popups.select.design_type.text'),
                        'html' => trans('popup::popups.select.design_type.html'),
                        'iframe' => trans('popup::popups.select.design_type.iframe'),
                        'video' => trans('popup::popups.select.design_type.video'),
                        'social' => trans('popup::popups.select.design_type.social')
                        ], old('design_type', $popup->design_type), ['class'=>'form-control select2', 'v-model'=>'design_type', 'v-on:change'=>'designTypeChanged'])
                        !!}


                        <div class="nav-tabs-custom">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                    <?php $i++; ?>
                                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                        @include('popup::admin.popups.partials.edit-fields', ['lang' => $locale])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="box-body">
                            <div id="#type_image" v-if="design_type == 'image'">
                                @mediaSingle('popupImage', $popup, null, trans('popup::popups.form.image'))
                            </div>

                            <div v-if="design_type == 'html'" class="form-group{{ $errors->has("design_desc") ? ' has-error' : '' }}">
                                {!! Form::label('design_desc', trans('popup::popups.form.design.html')) !!}
                                {!! Form::textarea('design_desc', old('design_desc', $popup->design_desc), ['class'=>'form-control', 'id'=>'code_mirror', "v-if"=>"design_type == 'html'", 'v-model'=>'design_desc']) !!}
                                {!! $errors->first("design_desc", '<span class="help-block">:message</span>') !!}
                            </div>

                            <div v-if="design_type == 'video'">
                                {!! Form::normalInput('design_desc', trans('popup::popups.form.design.video'), $errors, old('design_desc', $popup), ['v-model'=>'design_desc']) !!}
                            </div>

                            <div v-if="design_type == 'iframe'">
                                {!! Form::normalInput('design_desc', trans('popup::popups.form.design.iframe'), $errors, old('design_desc', $popup), ['placeholder'=>'http://www.domain.com', 'v-model'=>'design_desc']) !!}
                            </div>

                            <input name="design_desc" type="hidden" value="" v-if="design_type == 'social'" />
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.popup.popup.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include('popup::admin.popups.partials.settings')
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
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

@push('js-stack')
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.31.0/codemirror.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.31.0/codemirror.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.31.0/mode/xml/xml.min.js"></script>
<script src="{{ Module::asset('popup:js/vue.js') }}"></script>
<script type="text/javascript">
    var app = new Vue({
        el: '#app',
        data: {
            design_type: '{{ old('design_type', $popup->design_type) }}',
            code_mirror: null,
            design_desc: '{!! old('design_desc', $popup->design_desc) !!}'
        },
        mounted: function () {
            if(this.design_type == 'html') {
                CodeMirror.fromTextArea(document.getElementById('code_mirror'), {
                    mode: 'xml',
                    htmlMode: true,
                    lineNumbers: true,
                    lineWrapping: true
                });
            }
        },
        updated: function() {
            $('.CodeMirror').each(function() {
                $(this).remove();
            });
            if(this.design_type == 'text') {
                $('textarea.ckeditor').each(function(){
                    CKEDITOR.replace(this.id);
                });
            }
            if(this.design_type == 'html') {
                CodeMirror.fromTextArea(document.getElementById('code_mirror'), {
                    mode: 'xml',
                    htmlMode: true,
                    lineNumbers: true,
                    lineWrapping: true
                });
            }
        },
        methods: {
            designTypeChanged: function() {
                this.design_desc = '';
            }
        }
    });
    $(document).ready(function(){
        $('#start_at').datetimepicker({
            locale: '<?= App::getLocale() ?>',
            allowInputToggle: true,
            format: 'DD.MM.YYYY'
        });
        $('#end_at').datetimepicker({
            locale: '<?= App::getLocale() ?>',
            allowInputToggle: true,
            format: 'DD.MM.YYYY'
        });
        $('#start_hour').datetimepicker({
            locale: '<?= App::getLocale() ?>',
            allowInputToggle: true,
            format: 'HH:ss'
        });
        $('#end_hour').datetimepicker({
            locale: '<?= App::getLocale() ?>',
            allowInputToggle: true,
            format: 'HH:ss'
        });
    });
</script>
@endpush

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.popup.popup.index') ?>" }
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
        });
    </script>
@endpush
