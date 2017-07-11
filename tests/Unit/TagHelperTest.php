<?php

namespace ColbyGatte\Tests\Unit;

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
        tag_main_instance()->addFilter(function ($text) {
            return "__$text";
        });
        
        $this->assertEquals('__Colby', tag_main_instance()->get('Colby'));
    }
}