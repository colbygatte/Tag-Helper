<?php

use ColbyGatte\Html\TagHelper;

if (! function_exists('tag')) {
    /**
     * If a callback is given in place of $content, output buffering is used to capture the content.
     *
     * @param $tag
     * @param string $content
     * @param array $arguments
     *
     * @param null $instance
     *
     * @return \ColbyGatte\Html\TagHelper
     */
    function tag($tag, $content = '', $arguments = [])
    {
        return (new TagHelper)->tag($tag, $content, $arguments);
    }
}

if (! function_exists('red_snake_case')) {
    /**
     * @param $string
     * @param string $separator
     *
     * @return string
     */
    function red_snake_case($string, $separator = '_')
    {
        static $cache = [];
        
        return isset($cache[$separator.$string])
            ? $cache[$separator.$string]
            : ($cache[$separator.$string] = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', $separator.'$0', $string)), $separator));
    }
}