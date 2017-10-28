<div class="box-body">

    {!! Form::i18nInput('title', trans('popup::popups.form.title'), $errors, $lang) !!}

    <div v-if="design_type == 'text'">
    @editor('content', trans('popup::popups.form.content'), old("{$lang}.content"), $lang)
    </div>

</div>
