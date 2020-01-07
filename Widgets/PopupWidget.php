<?php
namespace Modules\Popup\Widgets;


use Modules\Popup\Repositories\PopupRepository;

class PopupWidget
{
    /**
     * @var PopupRepository
     */
    private $popup;

    public function __construct(PopupRepository $popup)
    {
        $this->popup = $popup;
    }

    /**
     * @param $template
     * @param string $view
     * @return |null
     */
    public function popup($template, $view = 'popup')
    {
        if($popup = $this->popup->getPopup($template))
        {
            return view('popup::widgets.'.$view, compact('popup'));
        }
        return null;
    }
}
