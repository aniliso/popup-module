<?php

namespace Modules\Popup\Repositories\Cache;

use Modules\Popup\Repositories\PopupRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePopupDecorator extends BaseCacheDecorator implements PopupRepository
{
    public function __construct(PopupRepository $popup)
    {
        parent::__construct();
        $this->entityName = 'popup.popups';
        $this->repository = $popup;
    }

    public function getPopups($template=null)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.getPopups.{$template}", $this->cacheTime,
                function () use ($template) {
                    return $this->repository->getPopups($template);
                }
            );
    }


    public function getPopup($template = null)
    {
        return $this->cache
            ->tags([$this->entityName, 'global'])
            ->remember("{$this->locale}.{$this->entityName}.getPopup.{$template}", $this->cacheTime,
                function () use ($template) {
                    return $this->repository->getPopup($template);
                }
            );
    }
}
