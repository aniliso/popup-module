<?php

namespace Modules\Popup\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Popup\Entities\Popup;
use Modules\Popup\Http\Requests\CreatePopupRequest;
use Modules\Popup\Http\Requests\UpdatePopupRequest;
use Modules\Popup\Repositories\PopupRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PopupController extends AdminBaseController
{
    /**
     * @var PopupRepository
     */
    private $popup;

    public function __construct(PopupRepository $popup)
    {
        parent::__construct();

        $this->popup = $popup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $popups = $this->popup->all();

        return view('popup::admin.popups.index', compact('popups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('popup::admin.popups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePopupRequest $request
     * @return Response
     */
    public function store(CreatePopupRequest $request)
    {
        $this->popup->create($request->all());

        return redirect()->route('admin.popup.popup.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('popup::popups.title.popups')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Popup $popup
     * @return Response
     */
    public function edit(Popup $popup)
    {
        return view('popup::admin.popups.edit', compact('popup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Popup $popup
     * @param  UpdatePopupRequest $request
     * @return Response
     */
    public function update(Popup $popup, UpdatePopupRequest $request)
    {
        $this->popup->update($popup, $request->all());

        return redirect()->route('admin.popup.popup.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('popup::popups.title.popups')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Popup $popup
     * @return Response
     */
    public function destroy(Popup $popup)
    {
        $this->popup->destroy($popup);

        return redirect()->route('admin.popup.popup.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('popup::popups.title.popups')]));
    }
}