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
        $table->addBodyRow(new Row(['Cell 34533', 'Cell 2', 'Cell 34']));

        $this->assertEquals(10, $table->getMaxCellLengthForColumn(0));
        $this->assertEquals(8, $table->getMaxCellLengthForColumn(1));
        $this->assertEquals(15, $table->getMaxCellLengthForColumn(2));
    }

    public function testRenderSimple()
    {
        $table = new Table();
        $table->addHeaderRow(new HeaderRow(['Column 1', 'Column 2', 'Column 3 - Test']));
        $table->addBodyRow(new Row(['Cell 1', 'Cell 234', 'Cell 3']));
        $table->addBodyRow(new Row(['Cell 12', 'Cell 23', 'Cell 34533']));
        $table->addBodyRow(new Row(['Cell 34533', 'Cell 2', 'Cell 34']));

        $output = $table->renderSimple();
        $expected = <<<EOT
==========  ========  ===============
Column 1    Column 2  Column 3 - Test
----------  --------  ---------------
Cell 1      Cell 234  Cell 3
Cell 12     Cell 23   Cell 34533
Cell 34533  Cell 2    Cell 34
==========  ========  ===============
EOT;

        $this->assertEquals($expected, $output);

        $table = new Table();
        $table->addHeaderRow(new HeaderRow(['Name', 'Description', 'Required', 'Default']));
        $table->addBodyRow(new Row(['directory', 'Plugin directory', 'No', '[]']));

        $output = $table->renderSimple();
        $expected = <<<EOT
=========  ================  ========  =======
Name       Description       Required  Default
---------  ----------------  --------  -------
directory  Plugin directory  No        []
=========  ================  ========  =======
EOT;

        $this->assertEquals($expected, $output);
    }

    public function testRenderWithArrayValue()
    {
        $table = new Table();
        $table->addHeaderRow(new HeaderRow(['Name', 'Description', 'Required', 'Default']));
        $table->addBodyRow(new Row(['directory', 'Plugin directory', 'No', ['test1', 'test2']]));

        $output = $table->renderSimple();
        $expected = <<<EOT
=========  ================  ========  ==============
Name       Description       Required  Default
---------  ----------------  --------  --------------
directory  Plugin directory  No        [test1, test2]
=========  ================  ========  ==============
EOT;

        $this->assertEquals($expected, $output);
    }

    public function testRenderNamedWithArrayValue()
    {
        $table = new Table();
        $table->addHeaderRow(new HeaderRow([
            'name' => 'Name',
            'description' => 'Description',
            'required' => 'Required',
            'default' => 'Default'
        ]));
        $table->addBodyRow(new Row([
            'name' => 'directory',
            'description' => 'Plugin directory',
            'required' => 'No',
            'default' => ['test1', 'test2']
        ]));

        $output = $table->renderSimple();
        $expected = <<<EOT
=========  ================  ========  ==============
Name       Description       Required  Default
---------  ----------------  --------  --------------
directory  Plugin directory  No        [test1, test2]
=========  ================  ========  ==============
EOT;

        $this->assertEquals($expected, $output);
    }

    public function testRenderAlias()
    {
        $table = new Table();
        $table->addHeaderRow(new HeaderRow(['Column 1', 'Column 2', 'Column 3 - Test']));
        $table->addBodyRow(new Row(['Cell 1', 'Cell 234', 'Cell 3']));
        $table->addBodyRow(new Row(['Cell 12', 'Cell 23', 'Cell 34533']));
        $table->addBodyRow(new Row(['Cell 34533', 'Cell 2', 'Cell 34']));

        $this->assertEquals($table->render(), $table->renderSimple());
    }
}
