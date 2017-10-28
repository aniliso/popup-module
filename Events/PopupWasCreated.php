<?php

namespace Modules\Popup\Events;

use Modules\Popup\Entities\Popup;
use Modules\Media\Contracts\StoringMedia;

class PopupWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Popup
     */
    public $popup;

    public function __construct($popup, array $data)
    {
        $this->data = $data;
        $this->popup = $popup;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->popup;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
