<?php

namespace CJDevStudios\RSTGen\Tests\Components\Table;

use CJDevStudios\RSTGen\Components\Table\Row;
use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
{

    public function testGetCells()
    {
        $row = new Row(['value 1', 'value 2', 'value 3']);
        $row2 = new Row(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3']);

        $this->assertCount(3, $row->getCells());
        $this->assertEquals([
            'value 1',
            'value 2',
            'value 3',
        ], $row->getCells());

        $this->assertCount(3, $row2->getCells());
        $this->assertEquals([
            'v1',
            'v2',
            'v3',
        ], $row2->getCells());
    }

    public function testGetCellHeaderKeys()
    {
        $row = new Row(['value 1', 'value 2', 'value 3']);
        $row2 = new Row(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3']);

        $this->assertCount(3, $row->getCellHeaderKeys());
        $this->assertEquals([0, 1, 2], $row->getCellHeaderKeys());

        $this->assertCount(3, $row2->getCellHeaderKeys());
        $this->assertEquals([
            'k1',
            'k2',
            'k3',
        ], $row2->getCellHeaderKeys());
    }
}
