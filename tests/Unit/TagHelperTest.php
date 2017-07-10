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
}