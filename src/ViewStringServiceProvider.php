<?php


namespace AdamGaskins\ViewString;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewStringServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Blade::directive('includeString', function ($args) {
            return eval("return \AdamGaskins\ViewString\ViewString::compile(".$args.", false);");
        });
    }
}
