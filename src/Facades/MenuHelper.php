<?php
/**
 * MenuHelper Facade
 *
 * @author: tuanha
 * @last-mod: 29-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

class MenuHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
