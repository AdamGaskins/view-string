<?php

use AdamGaskins\ViewString\ViewString;
use Illuminate\Contracts\Support\Arrayable;

if (! function_exists('view_string')) {
    /**
     * Compiles a string containing a Blade template.
     * @param string $string The Blade template
     * @param Arrayable|array $args The data to pass to the view
     * @return string The compiled output
     */
    function view_string(string $string, $data = []): string
    {
        return ViewString::compile($string, $data);
    }
}
