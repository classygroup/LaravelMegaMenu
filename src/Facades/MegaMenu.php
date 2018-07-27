<?php

namespace Classy\MegaMenu\Facades;

use Illuminate\Support\Facades\Facade;
use Classy\MegaMenu\Models\Menu;

class MegaMenu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MegaMenu';
    }
    /**
     * Display menu.
     *
     * @param string      $menuName
     * @param string|null $type
     * @param array       $options
     *
     * @return string
     */
    public static function display($menuName, $type = null, array $options = [])
    {
        return Menu::display($menuName, $type, $options);
    }




}
