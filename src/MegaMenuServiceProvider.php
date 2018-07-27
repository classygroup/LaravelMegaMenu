<?php

namespace Classy\MegaMenu;

use Classy\MegaMenu\Facades\MegaMenu;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Classy\MegaMenu\Facades\MegaMenu as MegaMenuFacade;;



class MegaMenuServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('MegaMenu', MegaMenuFacade::class);

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
        }

        $this->loadHelpers();
        $this->registerConfigs();

    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->registerBladeDirective();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'MegaMenu');
        $this->loadMigrationsFrom(realpath(__DIR__.'/../migrations'));
    }

    private function registerBladeDirective(){
        /**
         * Display menu.
         *
         * @param string      $menuName
         * @param string|null $type
         * @param array       $options
         *
         * @return string
         */
        Blade::directive('ClassyMenu', function($expression)
        {
            $params = explode(",",$expression);
            $options = [];
            $type = null;
            if(isset($params[1])){
                $type = $params[1];
            }
            if(in_array('color',$params)){
                $options['color'] =  true;
            }
            if(in_array('background',$params)){
                $options['background'] =  true;
            }
            if(in_array('icon',$params)){
                $options['icon'] =  true;
            }
            return MegaMenu::display($params[0],$type,$options);
        });
    }

    private function registerPublishableResources()
    {
        $publishablePath = dirname(__DIR__).'/publishable';

        $publishable = [
            'MegaMenu-Config' => [
                "{$publishablePath}/config/MegaMenu.php" => config_path('MegaMenu.php'),
            ],
            'MegaMenu-view' => [
                __DIR__."/../resources/views" => resource_path('view/Classy/MegaMenu'),
            ]
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/MegaMenu.php', 'MegaMenu'
        );
    }

}
