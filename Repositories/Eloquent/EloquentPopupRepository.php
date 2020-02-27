<?php

namespace Modules\Popup\Repositories\Eloquent;

use Modules\Popup\Events\PopupWasCreated;
use Modules\Popup\Events\PopupWasDeleted;
use Modules\Popup\Events\PopupWasUpdated;
use Modules\Popup\Repositories\PopupRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPopupRepository extends EloquentBaseRepository implements PopupRepository
{
    public function create($data)
    {
        $model = $this->model->create($data);

        event(new PopupWasCreated($model, $data));

        return $model;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new PopupWasUpdated($model, $data));

        return $model;
    }

    public function destroy($model)
    {
        event(new PopupWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

    public function getPopups($template = null)
    {
        return $this->model->where('template', $template)->betweenDates()->orderBy('start_at')->get();
    }

    /**
     * @param null $template
     * @return mixed
     */
    public function getPopup($template = null)
    {
        return $this->model->where('template', $template)->betweenDates()->orderBy('start_at')->first();
    }
}
