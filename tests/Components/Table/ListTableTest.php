<?php

namespace CJDevStudios\RSTGen\Tests\Components\Table;

use CJDevStudios\RSTGen\Components\Table\HeaderRow;
use CJDevStudios\RSTGen\Components\Table\ListTable;
use CJDevStudios\RSTGen\Components\Table\Row;

class ListTableTest extends TableTest
{

    public function testRender()
    {
        $table = new ListTable();
        $table->addHeaderRow(new HeaderRow(['Column 1', 'Column 2', 'Column 3 - Test']));
        $table->addBodyRow(new Row(['Cell 1', 'Cell 234', 'Cell 3']));
        $table->addBodyRow(new Row(['Cell 12', 'Cell 23', 'Cell 34533']));
        $table->addBodyRow(new Row(['Cell 34533', 'Cell 2', 'Cell 34']));

        $output = $table->render();
        $expected = <<<EOT
.. list-table::
   :widths: 10 8 15
   :header-rows: 1

   * - Column 1
     - Column 2
     - Column 3 - Test
   * - Cell 1
     - Cell 234
     - Cell 3
   * - Cell 12
     - Cell 23
     - Cell 34533
   * - Cell 34533
     - Cell 2
     - Cell 34
EOT;

        $this->assertEquals($expected, $output);

        $table = new ListTable();
        $table->addHeaderRow(new HeaderRow(['Name', 'Description', 'Required', 'Default']));
        $table->addBodyRow(new Row(['directory', 'Plugin directory', 'No', '[]']));

        $output = $table->render();
        $expected = <<<EOT
.. list-table::
   :widths: 9 16 8 7
   :header-rows: 1

   * - Name
     - Description
     - Required
     - Default
   * - directory
     - Plugin directory
     - No
     - []
EOT;

        $this->assertEquals($expected, $output);
    }

    public function testRenderWithArrayValue()
    {
        $table = new ListTable();
        $table->addHeaderRow(new HeaderRow(['Name', 'Description', 'Required', 'Default']));
        $table->addBodyRow(new Row(['directory', 'Plugin directory', 'No', ['test1', 'test2']]));

        $output = $table->render();
        $expected = <<<EOT
.. list-table::
   :widths: 9 16 8 14
   :header-rows: 1

   * - Name
     - Description
     - Required
     - Default
   * - directory
     - Plugin directory
     - No
     - [test1, test2]
EOT;

        $this->assertEquals($expected, $output);
    }

    public function testRenderNamedWithArrayValue()
    {
        $table = new ListTable();
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

        $output = $table->render();
        $expected = <<<EOT
.. list-table::
   :widths: 9 16 8 14
   :header-rows: 1

   * - Name
     - Description
     - Required
     - Default
   * - directory
     - Plugin directory
     - No
     - [test1, test2]
EOT;

        $this->assertEquals($expected, $output);
    }
}
