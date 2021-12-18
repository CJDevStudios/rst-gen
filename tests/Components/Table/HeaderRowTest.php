<?php

namespace CJDevStudios\RSTGen\Tests\Components\Table;

use CJDevStudios\RSTGen\Components\Table\HeaderRow;
use PHPUnit\Framework\TestCase;

class HeaderRowTest extends TestCase
{

    public function testGetHeaders()
    {
        $headerRow = new HeaderRow([
            'Header 1',
            'Header 2',
            'Header 3'
        ]);

        $this->assertEquals([
            'Header 1',
            'Header 2',
            'Header 3'
        ], $headerRow->getHeaders());
    }
}
