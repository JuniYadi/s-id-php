<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use JuniYadi\SID;

class ShortUrlTest extends TestCase
{
    public function testShort()
    {
        $url    = new SID();
        $short  = $url->short('https://google.com');

        $this->assertEquals($short['original'], 'https://google.com');
    }
}