<?php

namespace CJDevStudios\RSTGen\Tests\Components;

use CJDevStudios\RSTGen\Components\Section;
use PHPUnit\Framework\TestCase;

class SectionTest extends TestCase
{

    public function testRender()
    {
        $provider = [
            ['Test', 1, "####\nTest\n####\n\n"],
            ['Test', 2, "****\nTest\n****\n\n"],
            ['Test', 3, "Test\n====\n\n"],
            ['Test', 4, "Test\n----\n\n"],
            ['Test', 5, "Test\n^^^^\n\n"],
            ['Test', 6, "Test\n\"\"\"\"\n\n"],
        ];

        foreach ($provider as $test) {
            $section = new Section($test[0], $test[1]);
            $this->assertEquals($test[2], $section->render());
        }
    }
}
