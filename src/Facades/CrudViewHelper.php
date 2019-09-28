<?php
/**
 * CrudViewHelper Facade
 *
 * @author: tuanha
 * @last-mod: 28-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

class CrudViewHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'crudview';
    }
}
