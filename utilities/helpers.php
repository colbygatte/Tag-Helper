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