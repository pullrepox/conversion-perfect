<?php


namespace App\Http\Repositories;


class TinyMinify
{
    static function html($html, $options = [])
    {
        $minifier = new TinyHtmlMinifier($options);
        return $minifier->minify($html);
    }
}
