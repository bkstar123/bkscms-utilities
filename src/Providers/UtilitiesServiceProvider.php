<?php
/**
 * UtilitiesServiceProvider
 *
 * Register helpers to the application container
 *
 * @author: tuanha
 * @last-mod: 28-09-2019
 */
namespace Bkstar123\BksCMS\Utilities\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Bkstar123\BksCMS\Utilities\Helpers\MenuHelper;
use Bkstar123\BksCMS\Utilities\Helpers\CrudViewHelper;
use Bkstar123\BksCMS\Utilities\Facades\MenuHelper as MenuFacade;
use Bkstar123\BksCMS\Utilities\Facades\CrudViewHelper as CrudViewFacade;

class UtilitiesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton('crudview', function ($app) {
            return new CrudViewHelper();
        });

        App::singleton('menu', function ($app) {
            return new MenuHelper();
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('CrudView', CrudViewFacade::class);
        $loader->alias('Menu', MenuFacade::class);
    }
}
