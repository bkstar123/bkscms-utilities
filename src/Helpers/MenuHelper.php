<?php
/**
 * MenuHelper Helper
 *
 * @author: tuanha
 * @last-mod: 29-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Helpers;

use Bkstar123\BksCMS\Utilities\Services\MenuLink;

class MenuHelper
{
    /**
     * Create a menu sidebar link
     *
     * @param string $route
     * @param string $displayAs
     */
    public function link($route, $displayAs, $icon)
    {
        $contents = '<li class="nav-item">';
        $contents .= '<a href="' . $route . '"';
        $contents .=  'class="nav-link ' . $this->active($route) . '">';
        $contents .= '<i class="nav-icon ' . $icon . '"></i>';
        $contents .= '<p>' . $displayAs . '</p>';
        $contents .=  '</a></li>';

        echo $contents;
    }

    /**
     * Set active class for the active link
     *
     * @param string $url
     */
    public function active($url)
    {
        if (is_array($url)) {
            return in_array(url()->current(), $url) ? 'active' : '';
        } else {
            return url()->current() == $url ? 'active' : '';
        }
    }

    public function renderMenu()
    {
        $menu = [];

        foreach (config('menu') as $itemName => $item) {
            array_push($menu, new MenuLink($itemName, $item['self'], $item['icon'], $item['children']));
        }
        //dd($menu);
    }
}
