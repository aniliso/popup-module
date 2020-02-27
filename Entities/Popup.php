<?php

namespace Modules\Popup\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Laracasts\Presenter\PresentableTrait;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Popup\Presenters\PopupPresenter;

class Popup extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'popup__popups';
    public $translatedAttributes = ['title', 'content'];
    protected $fillable = ['title', 'content', 'design_type', 'design_desc', 'settings', 'start_at', 'end_at', 'start_hour', 'end_hour', 'template'];

    protected $presenter = PopupPresenter::class;

    protected $dates = [
        'start_at',
        'end_at'
    ];

    protected $casts = [
        'settings' => 'object'
    ];

    public function setStartAtAttribute($value)
    {
        return $this->attributes['start_at'] = Carbon::parse($value);
    }

    public function setEndAtAttribute($value)
    {
        return $this->attributes['end_at'] = Carbon::parse($value);
    }

    public function scopeBetweenDates($query)
    {
        return $query->whereRaw('(NOW() BETWEEN TIMESTAMP(start_at,start_hour) and TIMESTAMP(end_at,end_hour))');
    }

    public function scopeBetweenHours($query)
    {
        return $query->whereRaw('("'.Carbon::now()->format('H:i').'" BETWEEN start_hour and end_hour)');
    }
}
