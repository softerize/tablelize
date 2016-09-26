<?php

/*
 * This file is part of Softerize Tablelize
 *
 * (c) Softerize Sistemas <oscar.dias@softerize.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Softerize\Tablelize;

use Illuminate\Support\ServiceProvider;

class TablelizeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'tablelize');
        $this->registerHelpers();
        $this->publishAssets();
    }

    /**
     * Publish datatables assets.
     */
    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/resources/views' => base_path('/resources/views/vendor/softerize/tablelize'),
        ], 'table-list');
    }

    /**
     * Register helpers files
     */
    public function registerHelpers()
    {
        // Load the helpers in Helpers/helpers.php
        if (file_exists(__DIR__ . '/Helpers/helpers.php'))
        {
            require __DIR__ . '/Helpers/helpers.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
