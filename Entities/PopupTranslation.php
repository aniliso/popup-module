<?php

namespace Modules\Popup\Entities;

use Illuminate\Database\Eloquent\Model;

class PopupTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'content'];
    protected $table = 'popup__popup_translations';
}
