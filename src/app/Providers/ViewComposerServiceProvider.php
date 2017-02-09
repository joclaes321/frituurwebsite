<?php
/**
 * Created by PhpStorm.
 * User: jeffrey
 * Date: 8/15/16
 * Time: 11:43 PM
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', 'App\Http\ViewComposers\OrderViewComposer');
    }

    public function register()
    {

    }
}
