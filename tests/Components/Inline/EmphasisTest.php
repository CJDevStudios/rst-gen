<?php

namespace CJDevStudios\RSTGen\Tests\Components\Inline;

use CJDevStudios\RSTGen\Components\Inline\Emphasis;
use PHPUnit\Framework\TestCase;

class EmphasisTest extends TestCase
{

    public function testRender()
    {
        $emphasis = new Emphasis('foo');
        $this->assertEquals('*foo*', $emphasis->render());
    }
}
