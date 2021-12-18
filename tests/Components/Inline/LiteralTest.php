<?php

namespace CJDevStudios\RSTGen\Tests\Components\Inline;

use CJDevStudios\RSTGen\Components\Inline\Literal;
use PHPUnit\Framework\TestCase;

class LiteralTest extends TestCase
{

    public function testRender()
    {
        $literal = new Literal('foo');
        $this->assertEquals('``foo``', $literal->render());
    }
}
