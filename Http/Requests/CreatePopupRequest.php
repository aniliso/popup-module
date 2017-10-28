<?php

namespace Modules\Popup\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreatePopupRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'popup::popups.form';

    public function rules()
    {
        return [
            'start_at'                => 'required|date_format:"d.m.Y"',
            'end_at'                  => 'required|date_format:"d.m.Y"',
            'start_hour'              => 'required|date_format:"H:i"',
            'end_hour'                => 'required|date_format:"H:i"',
            'settings.width'          => 'required|integer',
            'settings.height'         => 'required|integer',
            'settings.cookie_expire'  => 'required|integer',
            'settings.close_delay_at' => 'required|integer',
            'settings.open_delay_at'  => 'required|integer',
            'design_desc'             => 'required_if:design_type,"html","video","iframe"',
            'settings.image_width'    => 'required_with:settings.image_height|required_if:design_type,"image"',
            'settings.image_height'   => 'required_with:settings.image_width|required_if:design_type,"image"',
        ];
    }

    public function attributes()
    {
        return [
            'design_type'             => trans('popup::popups.form.design_type'),
            'settings.width'          => trans('popup::popups.form.settings.width'),
            'settings.height'         => trans('popup::popups.form.settings.height'),
            'settings.cookie_expire'  => trans('popup::popups.form.settings.cookie_expire'),
            'settings.close_delay_at' => trans('popup::popups.form.settings.close_delay_at'),
            'settings.open_delay_at'  => trans('popup::popups.form.settings.open_delay_at'),
            'design_desc'             => trans('popup::popups.form.design_desc'),
            'settings.image_width'    => trans('popup::popups.form.settings.image_width'),
            'settings.image_height'   => trans('popup::popups.form.settings.image_height'),
        ];
    }

    public function translationRules()
    {
        return [
            'title'   => 'required_if:design_type,"text","html","iframe","video","social"',
            'content' => 'required_if:design_type,"text"',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
