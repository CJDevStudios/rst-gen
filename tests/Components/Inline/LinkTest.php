<?php

namespace CJDevStudios\RSTGen\Tests\Components\Inline;

use CJDevStudios\RSTGen\Components\Inline\Link;
use PHPUnit\Framework\TestCase;

class LinkTest extends TestCase
{

    public function testRender()
    {
        $link = new Link('https://www.example.com', 'This is an example link');
        $this->assertEquals('`This is an example link <https://www.example.com>`_', $link->render());
    }
}
