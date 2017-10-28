<?php

namespace Modules\Popup\Events;

use Modules\Media\Contracts\DeletingMedia;

class PopupWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $popupClass;
    /**
     * @var int
     */
    private $popupId;

    public function __construct($popupId, $popupClass)
    {
        $this->popupClass = $popupClass;
        $this->popupId = $popupId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->popupId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->popupClass;
    }
}
