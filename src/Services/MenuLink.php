<?php
/**
 * MenuLink service
 *
 * @author: tuanha
 * @last-mod: 29-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Services;

class MenuLink
{
	public $name = '';

	public $self = '';

	public $icon = '';

	public $children = [];

	public function __construct($name, $self, $icon, $children)
	{
		$this->name = $name;
		$this->self = $self;
		$this->icon = $icon;

		if (!empty($children)) {
			foreach ($children as $childName => $child) {
				array_push($this->children, new MenuLink($childName, $child['self'], $child['icon'], $child['children']));
			}
		}
	}

	public function isActive()
	{
		if (!empty($this->children)) {
			foreach ($this->children as $child) {
				if ($child->isActive()) {
					return true;
				}
			}
			return false;
		}
		return url()->current() === $this->self;
	}
}