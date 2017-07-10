<?php

namespace ColbyGatte\Tests\Unit;

use ColbyGatte\Html\TagHelper;
use ColbyGatte\Tests\TestCase;

class TagHelperTest extends TestCase
{
    /** @test */
    public function can_get_tag()
    {
        $this->assertEquals(
            tag_str('a', ['content' => 'Google', 'href' => '//google.com']),
            '<a href="//google.com">Google</a>'
        );
    }
    
    /** @test */
    public function can_add_filter()
    {
        TagHelper::getInstance()->addFilter(function ($text) {
            return "__$text";
        });
        
        $this->assertEquals('<p>__Colby</p>', tag_str('p', 'Colby'));
    }
}