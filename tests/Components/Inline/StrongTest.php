<?php

namespace CJDevStudios\RSTGen\Tests\Components\Inline;

use CJDevStudios\RSTGen\Components\Inline\Strong;
use PHPUnit\Framework\TestCase;

class StrongTest extends TestCase
{

    public function testRender()
    {
        $strong = new Strong('foo');
        $this->assertEquals('**foo**', $strong->render());
    }
}
