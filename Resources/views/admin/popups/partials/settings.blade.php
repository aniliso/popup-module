<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has("start_at") ? ' has-error' : '' }}">
                    {!! Form::label("start_at", trans('popup::popups.form.start_at').':') !!}
                    <div class='input-group date' id='start_at'>
                        <input type="text" class="form-control" name="start_at" value="{{ old('start_at',  isset($popup->start_at) ? $popup->start_at->format('d.m.Y') : Carbon::now()->hour(0)->minute(0)->format('d.m.Y')) }}"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    {!! $errors->first("start_at", '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has("start_hour") ? ' has-error' : '' }}">
                    {!! Form::label("start_hour", trans('popup::popups.form.start_hour').':') !!}
                    <div class='input-group date' id='start_hour'>
                        <input type="text" class="form-control" name="start_hour" value="{{ old('start_hour', isset($popup->start_hour) ? $popup->start_hour : Carbon::now()->hour(0)->minute(0)->format('H:i')) }}"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                    </div>
                    {!! $errors->first("start_hour", '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has("end_at") ? ' has-error' : '' }}">
                    {!! Form::label("end_at", trans('popup::popups.form.end_at').':') !!}
                    <div class='input-group date' id='end_at'>
                        <input type="text" class="form-control" name="end_at" value="{{ old('end_at', isset($popup->end_at) ? $popup->end_at->format('d.m.Y'): Carbon::now()->addDay(1)->hour(0)->minute(0)->format('d.m.Y')) }}"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    {!! $errors->first("end_at", '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has("end_hour") ? ' has-error' : '' }}">
                    {!! Form::label("end_hour", trans('popup::popups.form.end_hour').':') !!}
                    <div class='input-group date' id='end_hour'>
                        <input type="text" class="form-control" name="end_hour" value="{{ old('end_hour', isset($popup->end_hour) ? $popup->end_hour : Carbon::now()->hour(23)->minute(59)->format('H:i')) }}"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                    </div>
                    {!! $errors->first("end_hour", '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class='form-group{{ $errors->has("template") ? ' has-error' : '' }}'>
                    {!! Form::label("template", trans('popup::popups.form.template')) !!}
                    {!! Form::select("template", $all_templates, old("template", isset($popup->template)?$popup->template:''), ['class' => "form-control select2", 'placeholder' => trans('page::pages.form.template')]) !!}
                    {!! $errors->first("template", '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <legend>Tasarım Ayarları</legend>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group{{ $errors->has("settings.width") ? ' has-error' : '' }}">
                                {!! Form::label('settings.width', trans('popup::popups.form.settings.width')) !!}
                                {!! Form::text("settings[width]", old('settings.width', !isset($popup->settings->width)?600:$popup->settings->width), ['class'=>'form-control']) !!}
                                {!! $errors->first("settings.width", '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left: 0;">
                            {!! Form::label('settings.width_type', '&nbsp;') !!}
                            {!! Form::select("settings[width_type]", ['px'=>'px', '%'=>'%'], old('settings.width_type', isset($popup->settings->width_type) ? $popup->settings->width_type : 'px'), ['class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group{{ $errors->has("settings.height") ? ' has-error' : '' }}">
                                {!! Form::label('settings.height', trans('popup::popups.form.settings.height')) !!}
                                {!! Form::text("settings[height]", old('settings.height', !isset($popup->settings->height)?400:$popup->settings->height), ['class'=>'form-control']) !!}
                                {!! $errors->first("settings.height", '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left: 0;">
                            {!! Form::label('settings.height_type', '&nbsp;') !!}
                            {!! Form::select("settings[height_type]", ['px'=>'px', '%'=>'%'], old('settings.height_type', isset($popup->settings->height_type) ? $popup->settings->height_type : 'px'), ['class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has("settings.position") ? ' has-error' : '' }}">
                        {!! Form::label('settings.position', trans('popup::popups.form.settings.position')) !!}
                        {!! Form::select("settings[position]", ['top' => trans('popup::popups.select.position.top'), 'center' => trans('popup::popups.select.position.center'), 'bottom' => trans('popup::popups.select.position.bottom')], old('settings.position', isset($popup->settings->position) ? $popup->settings->position : 'center'), ['class'=>'form-control select2']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox("settings[show_header]", 1, old('settings.show_header', isset($popup->settings->show_header) ? $popup->settings->show_header : 0), ['class'=>'flat-blue']) !!}
                        {{ trans('popup::popups.form.settings.show_header') }}
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox("settings[show_close]", 1, old('settings.show_close', isset($popup->settings->show_close) ? $popup->settings->show_close : 0), ['class'=>'flat-blue']) !!}
                        {{ trans('popup::popups.form.settings.show_close') }}
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox("settings[show_counter]", 1, old('settings.show_counter', isset($popup->settings->show_counter) ? $popup->settings->show_counter : 0), ['class'=>'flat-blue']) !!}
                        {{ trans('popup::popups.form.settings.show_counter') }}
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>Oturum Ayarları</legend>
                    <div class="form-group">
                        <label for="settings[show_session]">
                            {!! Form::checkbox("settings[show_session]", 1, old('settings.show_session', isset($popup->settings->show_session) ? $popup->settings->show_session : 0), ['class'=>'flat-blue']) !!}
                            {{ trans('popup::popups.form.settings.show_session') }}
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="settings[show_once]">
                            {!! Form::checkbox("settings[show_once]", 1, old('settings.show_once', isset($popup->settings->show_once) ? $popup->settings->show_once : 1), ['class'=>'flat-blue']) !!}
                            {{ trans('popup::popups.form.settings.show_once') }}
                        </label>
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox("settings[auto_close]", 1, old('settings.auto_close', isset($popup->settings->auto_close) ? $popup->settings->auto_close : 0), ['class'=>'flat-blue']) !!}
                        {{ trans('popup::popups.form.settings.auto_close') }}
                    </div>
                    <div class="form-group {{ $errors->has("settings.cookie_expire") ? ' has-error' : '' }}">
                        {!! Form::label('settings.cookie_expire', trans('popup::popups.form.settings.cookie_expire')) !!}
                        {!! Form::text("settings[cookie_expire]", old('settings.cookie_expire', isset($popup->settings->cookie_expire) ? $popup->settings->cookie_expire : 30), ['class'=>'form-control']) !!}
                        {!! $errors->first("settings.cookie_expire", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group{{ $errors->has("settings.close_delay_at") ? ' has-error' : '' }}">
                        {!! Form::label('settings.close_delay_at', trans('popup::popups.form.settings.close_delay_at')) !!}
                        {!! Form::text("settings[close_delay_at]", old('settings.close_delay_at', isset($popup->settings->close_delay_at) ? $popup->settings->close_delay_at : 10), ['class'=>'form-control']) !!}
                        {!! $errors->first("settings.close_delay_at", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group{{ $errors->has("settings.open_delay_at") ? ' has-error' : '' }}">
                        {!! Form::label('settings.open_delay_at', trans('popup::popups.form.settings.open_delay_at')) !!}
                        {!! Form::text("settings[open_delay_at]", old('settings.open_delay_at', isset($popup->settings->open_delay_at) ? $popup->settings->open_delay_at : 5), ['class'=>'form-control']) !!}
                        {!! $errors->first("settings.open_delay_at", '<span class="help-block">:message</span>') !!}
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row" v-if="this.design_type == 'image'">
            <div class="col-md-12">
                <fieldset>
                    <legend>Resim Ayarları</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has("settings.image_width") ? ' has-error' : '' }}">
                                {!! Form::label('settings.image_width', trans('popup::popups.form.settings.image_width')) !!}
                                {!! Form::text("settings[image_width]", old('settings.image_width', isset($popup->settings->image_width) ? $popup->settings->image_width : 640), ['class'=>'form-control']) !!}
                                {!! $errors->first("settings.image_width", '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has("settings.image_height") ? ' has-error' : '' }}">
                                {!! Form::label('settings.image_height', trans('popup::popups.form.settings.image_height')) !!}
                                {!! Form::text("settings[image_height]", old('settings.image_height', isset($popup->settings->image_height) ? $popup->settings->image_height : 480), ['class'=>'form-control']) !!}
                                {!! $errors->first("settings.image_height", '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Uyum Ayarları</legend>
                    <div class="form-group pull-left">
                        <label for="settings[show_desktop]">
                            {!! Form::checkbox("settings[show_desktop]", 1, old('settings.show_desktop', isset($popup->settings->show_desktop) ? $popup->settings->show_desktop : ''), ['class'=>'flat-blue']) !!}
                            {{ trans('popup::popups.form.settings.show_desktop') }}
                        </label>
                    </div>
                    <div class="form-group pull-left" style="margin-left: 10px;">
                        <label for="settings[show_tablet]">
                            {!! Form::checkbox("settings[show_tablet]", 1, old('settings.show_tablet', isset($popup->settings->show_tablet) ? $popup->settings->show_tablet : ''), ['class'=>'flat-blue']) !!}
                            {{ trans('popup::popups.form.settings.show_tablet') }}
                        </label>
                    </div>
                    <div class="form-group pull-left" style="margin-left: 10px;">
                        <label for="settings[show_mobile]">
                            {!! Form::checkbox("settings[show_mobile]", 1, old('settings.show_mobile', isset($popup->settings->show_mobile) ? $popup->settings->show_mobile : ''), ['class'=>'flat-blue']) !!}
                            {{ trans('popup::popups.form.settings.show_mobile') }}
                        </label>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>