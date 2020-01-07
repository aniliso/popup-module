<?php

namespace Modules\Popup\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PopupRepository extends BaseRepository
{
    public function getPopups($template = null);

    public function getPopup($template = null);
}
