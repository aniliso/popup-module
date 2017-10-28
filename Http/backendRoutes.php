<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/popup'], function (Router $router) {
    $router->bind('popup', function ($id) {
        return app('Modules\Popup\Repositories\PopupRepository')->find($id);
    });
    $router->get('popups', [
        'as' => 'admin.popup.popup.index',
        'uses' => 'PopupController@index',
        'middleware' => 'can:popup.popups.index'
    ]);
    $router->get('popups/create', [
        'as' => 'admin.popup.popup.create',
        'uses' => 'PopupController@create',
        'middleware' => 'can:popup.popups.create'
    ]);
    $router->post('popups', [
        'as' => 'admin.popup.popup.store',
        'uses' => 'PopupController@store',
        'middleware' => 'can:popup.popups.create'
    ]);
    $router->get('popups/{popup}/edit', [
        'as' => 'admin.popup.popup.edit',
        'uses' => 'PopupController@edit',
        'middleware' => 'can:popup.popups.edit'
    ]);
    $router->put('popups/{popup}', [
        'as' => 'admin.popup.popup.update',
        'uses' => 'PopupController@update',
        'middleware' => 'can:popup.popups.edit'
    ]);
    $router->delete('popups/{popup}', [
        'as' => 'admin.popup.popup.destroy',
        'uses' => 'PopupController@destroy',
        'middleware' => 'can:popup.popups.destroy'
    ]);
// append

});
