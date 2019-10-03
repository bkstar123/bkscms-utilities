<?php
/**
 * MenuHelper Helper
 *
 * @author: tuanha
 * @last-mod: 29-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Helpers;

use Bkstar123\BksCMS\Utilities\Components\MenuLink;

class MenuHelper
{
    /**
     * Create a full menu side bar
     */
    public function renderMenu()
    {
        $contents = '';
        foreach (config('bkstar123_bkscms_sidebarmenu') as $link) {
            $menuItem = new MenuLink(
                $link['name'],
                $link['path'],
                $link['icon'] ?? '',
                $link['children'] ?? []
            );
            $contents .= $this->createLink($menuItem);
        }
        echo $contents;
    }

    /**
     * Create a menu sidebar link
     *
     * @param Bkstar123\BksCMS\Utilities\Components\MenuLink $link
     * @return string
     */
    protected function createLink(MenuLink $link)
    {
        if ($link->isExpandable()) {
            return $this->expandableLink($link);
        }
        return $this->monolink($link);
    }

    /**
     * Create a mono link
     *
     * @param Bkstar123\BksCMS\Utilities\Components\MenuLink $link
     * @return string
     */
    protected function monolink(MenuLink $link)
    {
        $contents = '<li class="nav-item">';
        $contents .= '<a href="' . $link->path . '"';
        $contents .=  'class="nav-link ' . $link->activeClass() . '">';
        $contents .= '<i class="nav-icon ' . $link->icon . '"></i>';
        $contents .= '<p>' . $link->name . '</p>';
        $contents .=  '</a></li>';

        return $contents;
    }

    /**
     * Create an expandable link
     *
     * @param Bkstar123\BksCMS\Utilities\Components\MenuLink $link
     * @return string
     */
    protected function expandableLink(MenuLink $link)
    {
        $contents = '<li class="nav-item has-treeview ' . $link->menuOpenClass() . '">';
        $contents .= '<a href="' . $link->path . '" ';
        $contents .= 'class="nav-link ' . $link->activeClass() . '">';
        $contents .= '<i class="nav-icon ' . $link->icon . '"></i>';
        $contents .= '<p>' . $link->name .' <i class="right fas fa-angle-left"></i></p></a>';
        $contents .= '<ul class="nav nav-treeview">';
        foreach ($link->children as $child) {
            $contents .= $this->createLink($child);
        }
        $contents .= '</ul></li>';
        return $contents;
    }
}
