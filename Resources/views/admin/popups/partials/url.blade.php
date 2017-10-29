<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach(LaravelLocalization::getSupportedLocales() as $locale => $language)
            <li class="{{ $loop->first ? 'active' : '' }}"><a href="#url_{{ $locale }}" data-toggle="tab">{{ $language['native'] }}</a></li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach(LaravelLocalization::getSupportedLocales() as $locale => $language)
            <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="url_{{ $locale }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has("settings.link_title") ? ' has-error' : '' }}">
                            {!! Form::label("settings.link_title", 'Link Başlığı:') !!}
                            {!! Form::input('text', 'settings[link_title]['.$locale.']', old('settings.link_title.'.$locale, $popup->settings->link_title->{$locale} ?? ''), ['class'=>'form-control']) !!}
                            {!! $errors->first("settings.link_title.".$locale, '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group{{ $errors->has("settings.link_url") ? ' has-error' : '' }}">
                            {!! Form::label("settings.link_url", 'Link:') !!}
                            {!! Form::input('text', 'settings[link_url]['.$locale.']', old('settings.link_url.'.$locale, $popup->settings->link_url->{$locale} ?? ''), ['class'=>'form-control']) !!}
                            {!! $errors->first("settings.link_url.".$locale, '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>