<?php

namespace CJDevStudios\RSTGen\Components\Table;

/**
 * Restructured Text Table Row
 */
class Row
{

    private $cells = [];

    private $cell_header_keys = [];

    public function __construct(array $values = [])
    {
        //Ex: $values = ['header1' => 'value1', 'header2' => 'value2']
        //Ex 2: $values = ['value1', 'value2']
        //Normalize as 1d array and store index -> key maps in $cell_header_keys
        //$this->cells = array_values($values);

        // convert all values in $values that are arrays to strings and store all in $cells
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $value = '['.implode(', ', $value).']';
            }
            $this->cells[] = $value;
            $this->cell_header_keys[count($this->cells) - 1] = $key;
        }
    }

    public function getCells()
    {
        return $this->cells;
    }

    public function getCellHeaderKeys()
    {
        return $this->cell_header_keys;
    }

    public function getMaxCellLength()
    {
        return max(array_map('strlen', $this->cells));
    }

    public function getCellByHeaderKey($header_key)
    {
        $index = array_search($header_key, $this->cell_header_keys, true);
        return $this->cells[$index];
    }
}
