<?php

namespace Classy\MegaMenu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;

/**
 * @todo: Refactor this class by using something like MenuBuilder Helper.
 */
class Menu extends Model
{
    protected $table = 'menus';

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function parent_items()
    {
        return $this->hasMany(MenuItem::class)
            ->whereNull('parent_id');
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
        // GET THE MENU - sort collection in blade
        $menu = static::where('name', '=', $menuName)
            ->with(['parent_items.children' => function ($q) {
                $q->orderBy('order');
            }])
            ->first();

           // Check for Menu Existence
            if (!isset($menu)) {
                return false;
            }

            // Convert options array into object
            $options = (object) $options;
            if (is_null($type)) {
                $type = 'MegaMenu::default';
            } elseif ($type == 'bootstrap' && !view()->exists($type)) {
                $type = 'MegaMenu::bootstrap';
            } elseif ($type == 'materialize' && !view()->exists($type)) {
                $type = 'MegaMenu::materialize';
            }

        return new HtmlString(
            View::make($type, ['items' => $menu->parent_items->sortBy('order'), 'options' => $options])->render()
        );
    }


}
