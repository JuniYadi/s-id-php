<?php

namespace Tests;

use JuniYadi\SID;
use PHPUnit\Framework\TestCase;

class ShortUrlTest extends TestCase
{
    public function testShort()
    {
        $url = new SID();
        $short = $url->short('https://google.com');

        $this->assertEquals($short['original'], 'https://google.com');
    }
}
