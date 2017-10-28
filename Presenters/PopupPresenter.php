<?php namespace Modules\Popup\Presenters;

use Modules\Core\Presenters\BasePresenter;
use Embed\Embed;
use Embed\Utils;

class PopupPresenter extends BasePresenter
{
    protected $zone = 'popupImage';

    public function content()
    {
        switch ($this->entity->design_type) {
            case 'text':
                return $this->entity->content;
                break;
            case 'html':
                return $this->entity->design_desc;
                break;
            case 'image':
                return \Html::image($this->firstImage($this->entity->settings->image_width, $this->entity->settings->image_height, 'fit', 80), $this->entity->title);
                break;
            case 'iframe':
                $iframe = Utils::iframe($this->entity->design_desc, $this->entity->settings->width . 'px', $this->entity->settings->height . 'px', 'overflow:hidden;');
                return $iframe;
                break;
            case 'video':
                $video = Embed::create($this->entity->design_desc, [
                    'min_image_width'  => $this->entity->settings->width,
                    'min_image_height' => $this->entity->settings->height,
                ]);
                return $video->getCode();
                break;
        }
    }
}