<?php

namespace Modules\Popup\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterPopupSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('popup::popups.title.popups'), function (Item $item) {
                $item->icon('fa fa-external-link-square');
                $item->weight(30);
                $item->append('admin.popup.popup.create');
                $item->route('admin.popup.popup.index');
                $item->authorize(
                    $this->auth->hasAccess('popup.popups.index')
                );
            });
        });

        return $menu;
    }
}
