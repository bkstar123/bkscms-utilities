<?php
/**
 * MenuLink component
 *
 * @author: tuanha
 * @last-mod: 29-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Components;

class MenuLink
{
    /**
     * Name of the link
     * @var string
     */
    public $name = '';

    /**
     * Link path
     * @var string
     */
    public $path = '';

    /**
     * Link Icon
     * @var string
     */
    public $icon = '';

    /**
     * Link's sub-links
     * @var array
     */
    public $children = [];

    /**
     * Create a MenuLink instance
     *
     * @param $name  string
     * @param $self  string
     * @param $icon  string
     * @param $children  array
     */
    public function __construct(string $name = '', string $path = '', string $icon = '', array $children = [])
    {
        $this->name = $name;
        $this->path = $path;
        $this->icon = $icon;
        if (!empty($children)) {
            foreach ($children as $child) {
                array_push(
                    $this->children,
                    new MenuLink(
                        $child['name'],
                        $child['path'],
                        $child['icon'] ?? '',
                        $child['children'] ?? []
                    )
                );
            }
        }
    }

    /**
     * Check if a link is expandable i.e contains sub-links
     *
     * @return bool
     */
    public function isExpandable()
    {
        return !empty($this->children);
    }

    /**
     * Add 'active' class to the link if it is active
     *
     * @return string
     */
    public function activeClass()
    {
        return $this->isActive() ? 'active' : '';
    }

    /**
     * Add 'menu-open' class to an expandable link if any of its sub-links is active
     *
     * @return string
     */
    public function menuOpenClass()
    {
        return $this->isExpandable() && $this->isActive() ? 'menu-open' : '';
    }

    /**
     * Check if a link is active
     *
     * @return bool
     */
    protected function isActive()
    {
        if (!empty($this->children)) {
            foreach ($this->children as $child) {
                if ($child->isActive()) {
                    return true;
                }
            }
            return false;
        } else {
            return parse_url(url()->current(), PHP_URL_PATH) === $this->path;
        }
    }
}
