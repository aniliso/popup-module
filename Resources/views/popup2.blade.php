<link rel="stylesheet" type="text/css" href="{!! Module::asset('popup:css/popup/jquery.popup.css') !!}"/>
<script src="{!! Module::asset('popup:js/popup/jquery.popup.js') !!}"></script>

<div class="eupopup eupopup-container eupopup-container-block">
    <div class="eupopup-markup">
        <div class="eupopup-head">{{ $popup->title }}</div>
        <div class="eupopup-body">{!! $popup->present()->content !!}</div>
        <div class="eupopup-buttons">
            <a href="#" class="eupopup-button eupopup-button_1">Continue</a>
            <a href="http://www.wimagguc.com/?cookie-policy" target="_blank" class="eupopup-button eupopup-button_2">Learn more</a>
        </div>
        <div class="clearfix"></div>
        <a href="#" class="eupopup-closebutton">x</a>
    </div>
</div>

<script>
    $(document).euCookieLawPopup().init({
        cookiePolicyUrl : 'http://www.wimagguc.com/?cookie-policy',
        popupPosition : 'bottomleft',
        colorStyle : 'default',
        compactStyle : false,
        popupTitle : 'This website is using cookies',
        popupText : '{!! $popup->present()->content !!}',
        buttonContinueTitle : 'Continue',
        buttonLearnmoreTitle : 'Learn more',
        buttonLearnmoreOpenInNewWindow : true,
        agreementExpiresInDays : 0,
        autoAcceptCookiePolicy : false,
        htmlMarkup : null
    });
</script>