<?php

namespace Motikan2010\SensitiveResponseDetector;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @param Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->publishes([
            __DIR__ . '/Config/detector.php' => config_path('detector.php'),
            __DIR__ . '/Resources/lang'      => resource_path('lang/vendor/detector'),
        ], 'detector');
        $router->aliasMiddleware('sensitive.detector', 'Motikan2010\SensitiveResponseDetector\Middleware\DetectSensitiveResponse');
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        $lang_path = resource_path('lang/vendor/detector');

        if ( is_dir($lang_path) ) {
            $this->loadTranslationsFrom($lang_path, 'detector');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/Resources/lang', 'detector');
        }
    }

}
