<div class="box-body">
    {!! Form::i18nInput('title', trans('popup::popups.form.title'), $errors, $lang, $popup) !!}

    <div v-if="design_type == 'text'">
    @editor('content', trans('popup::popups.form.content'), old("{$lang}.content", $popup->translate($lang)->content ?? null), $lang)
    </div>
</div>
