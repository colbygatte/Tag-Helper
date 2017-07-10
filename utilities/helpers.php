<?php

use ColbyGatte\Html\TagHelper;


if (! function_exists('tag')) {
    /**
     * If a callback is given in place of $content, output buffering is used to capture the content.
     *
     * @param $tag
     * @param $content
     * @param array $arguments
     *
     * @return \ColbyGatte\WpTheme\Translator
     */
    function tag($tag, $content = '', $arguments = [])
    {
        static $translator;
        
        $translator = $translator ?: TagHelper::getInstance();
        
        return $translator->tag($tag, $content, $arguments);
    }
}

if (! function_exists('tag_echo')) {
    /**
     * @param $tag
     * @param string $content
     * @param array $arguments
     */
    function tag_echo($tag, $content = '', $arguments = [])
    {
        tag($tag, $content, $arguments)->print();
    }
}

if (! function_exists('tag_str')) {
    /**
     * @param $tag
     * @param string $content
     * @param array $arguments
     *
     * @return mixed
     */
    function tag_str($tag, $content = '', $arguments = [])
    {
        return tag($tag, $content, $arguments)->str();
    }
}
