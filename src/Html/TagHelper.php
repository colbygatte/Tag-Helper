<?php

namespace ColbyGatte\Html;

/**
 * Class TagHelper
 */
class TagHelper
{
    /**
     * @var
     */
    protected static $instance = null;
    
    /**
     * Current tag.
     *
     * @var string
     */
    protected $tag;
    
    /**
     * @var callable|string
     */
    protected $content;
    
    /**
     * @var array
     */
    protected $formattedArguments = [];
    
    /**
     * @var array
     */
    protected $attributes = [];
    
    /**
     * @var array
     */
    protected $selfClosingTags = [
        'img' => true,
        'br' => true
    ];
    
    /**
     * @return static
     */
    public static function getInstance()
    {
        return static::$instance ?: static::$instance = new static;
    }
    
    /**
     * @return string
     */
    public function str()
    {
        return $this->__toString();
    }
    
    /**
     * @return string
     */
    function __toString()
    {
        $tag = $this->tag;
        
        $html = "<{$tag}{$this->makeAttributes()}>";
        
        if (isset($this->selfClosingTags[$this->tag])) {
            return $html;
        }
        
        if (is_callable($content = $this->content)) {
            ob_start();
            $content();
            $html .= ob_get_clean();
        } else {
            $html .= $this->get($content, ...$this->formattedArguments);
        }
        
        $html .= "</{$tag}>";
        
        return $html;
    }
    
    /**
     * @return string
     */
    protected function makeAttributes()
    {
        $attributes = [];
        
        foreach ($this->attributes as $name => $value) {
            $attributes[] = $name.'="'.htmlentities($value).'"';
        }
        
        // Reset settings for next tag
        $this->attributes = [];
        
        return (! empty($attributes)) ? ' '.implode(' ', $attributes) : '';
    }
    
    /**
     * This can be overridden in a sub-class to filter text however needed.
     *
     * @param string $text
     * @param array ...$arguments
     *
     * @return string|void
     */
    public function get($text, ...$arguments)
    {
        return sprintf($text, ...$arguments);
    }
    
    /**
     * @param       $text
     * @param array ...$arguments
     */
    public function print($text = null, ...$arguments)
    {
        if (is_null($text)) {
            echo $this;
        }
        
        echo $this->get($text, ...$arguments);
    }
    
    /**
     * @param $tag
     * @param string $content
     * @param array $arguments
     *
     * @return $this
     */
    public function tag($tag, $content = '', $arguments = [])
    {
        $this->tag = $tag;
        
        if (is_array($content)) {
            $this->set($content);
            
            return $this;
        }
        
        $this->content = $content;
        
        $this->formattedArguments = $arguments;
        
        return $this;
    }
    
    /**
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function set($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $attribute => $value) {
                $this->set($attribute, $value);
            }
            
            return $this;
        }
        
        if ($name == 'content') {
            $this->content = $value;
        } else {
            $this->attributes[$name] = $value;
        }
        
        return $this;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    /**
     * @param $name
     * @param $arguments
     *
     * @return \ColbyGatte\Html\TagHelper
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (substr($name, 0, 3) == 'set') {
            return $this->set(
                snake_case(substr($name, 3), '-'),
                $arguments[0]
            );
        }
        
        throw new \Exception("Invalid method call: $name");
    }
    
    /**
     * Set and then echo.
     *
     * @param $name
     * @param null $value
     *
     * @return $this
     */
    public function setEcho($name, $value = null)
    {
        $this->set($name, $value);
        
        echo $this;
        
        return $this;
    }
}