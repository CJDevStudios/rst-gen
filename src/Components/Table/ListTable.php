<?php

namespace CJDevStudios\RSTGen\Components\Table;

class ListTable extends Table {

    public function render(array $options = []): string
    {
        // Calculate some values
        $max_col_lengths = [];
        foreach ($this->header_rows as $header_row) {
            foreach ($header_row->getHeaders() as $col => $header) {
                $max_col_lengths[$col] = $this->getMaxCellLengthForColumn($col);
            }
        }

        $output = '';

        // Print directive
        $output .= '.. list-table::' . "\n";
        // Print table arguments
        $output .= '   :widths: ' . implode(' ', $max_col_lengths) . "\n";
        $output .= '   :header-rows: ' . count($this->header_rows) . "\n";

        // Print blank line between directive and table
        $output .= "\n";

        // Print data row by row starting with header rows
        foreach ($this->header_rows as $header_row) {
            $output .= $this->renderRow($header_row->getHeaders());
        }
        foreach ($this->body_rows as $body_row) {
            $output .= $this->renderRow($body_row->getCells());
        }

        return rtrim($output);
    }

    protected function renderRow(array $cells): string
    {
        $output = '   *';
        $first = true;
        foreach ($cells as $cell) {
            if (!$first) {
                $output .= '    ';
            } else {
                $first = false;
            }
            $output .= " - $cell\n";
        }
        return $output;
    }
}
