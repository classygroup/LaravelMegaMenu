<?php



if (!function_exists('ClassyMenu')) {
    /**
     * Display menu.
     *
     * @param string      $menuName
     * @param string|null $type
     * @param array       $options
     *
     * @return string
     */
    function ClassyMenu($menuName, $type = null, array $options = [])
    {
        return Classy\MegaMenu\Facades\MegaMenu::display($menuName, $type, $options);
    }
}


