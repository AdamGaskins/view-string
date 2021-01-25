<?php

namespace AdamGaskins\ViewString;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Blade;

class ViewString
{
    /**
     * Compiles a string containing a Blade template.
     * @param string $string The Blade template
     * @param Arrayable|array $args
     * @return string The compiled output
     */
    public static function compile(string $string, $data = [])
    {
        $data = $data instanceof Arrayable ? $data->toArray() : $data;

        $php = Blade::compileString($string);

        ob_start() and extract($data, EXTR_SKIP);

        try {
            eval('?>'.$php);
        } catch (\Exception $e) {
            ob_get_clean();

            throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}
