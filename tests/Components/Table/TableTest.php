<?php

namespace CJDevStudios\RSTGen\Tests\Components\Table;

use CJDevStudios\RSTGen\Components\Table\HeaderRow;
use CJDevStudios\RSTGen\Components\Table\Row;
use CJDevStudios\RSTGen\Components\Table\Table;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{

    public function testGetMaxCellLengthForColumn()
    {
        $table = new Table();
        $table->addHeaderRow(new HeaderRow(['Column 1', 'Column 2', 'Column 3 - Test']));
        $table->addBodyRow(new Row(['Cell 1', 'Cell 234', 'Cell 3']));
        $table->addBodyRow(new Row(['Cell 12', 'Cell 23', 'Cell 34533']));
        $table->addBodyRow(new Row(['Cell 123', 'Cell 2', 'Cell 34']));

        $this->assertEquals(8, $table->getMaxCellLengthForColumn(0));
        $this->assertEquals(8, $table->getMaxCellLengthForColumn(1));
        $this->assertEquals(15, $table->getMaxCellLengthForColumn(2));
    }

    public function testRenderSimple()
    {
        $table = new Table();
        $table->addHeaderRow(new HeaderRow(['Column 1', 'Column 2', 'Column 3 - Test']));
        $table->addBodyRow(new Row(['Cell 1', 'Cell 234', 'Cell 3']));
        $table->addBodyRow(new Row(['Cell 12', 'Cell 23', 'Cell 34533']));
        $table->addBodyRow(new Row(['Cell 123', 'Cell 2', 'Cell 34']));

        $output = $table->renderSimple();
        $expected = <<<EOT
========  ========  ===============
Column 1  Column 2  Column 3 - Test
--------  --------  ---------------
Cell 1    Cell 234  Cell 3
Cell 12   Cell 23   Cell 34533
Cell 123  Cell 2    Cell 34
========  ========  ===============
EOT;

        $this->assertEquals($expected, $output);
    }
}
