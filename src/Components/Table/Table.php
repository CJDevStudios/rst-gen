<?php

namespace CJDevStudios\RSTGen\Components\Table;

use CJDevStudios\RSTGen\Components\ComponentInterface;

/**
 * Restructured Text Table Component
 */
class Table implements ComponentInterface
{

    /**
     * @var HeaderRow[]
     */
    private array $header_rows = [];

    /**
     * @var Row[]
     */
    private array $body_rows = [];

    public function __construct()
    {
    }

    public function addHeaderRow(HeaderRow $row)
    {
        $this->header_rows[] = $row;
    }

    public function addBodyRow(Row $row)
    {
        $this->body_rows[] = $row;
    }

    public function getMaxCellLengthForColumn($col)
    {
        $max_length = 0;

        foreach ($this->header_rows as $header_row) {
            $max_length = max($max_length, strlen($header_row->getHeaders()[$col] ?? ''));
        }

        foreach ($this->body_rows as $body_row) {
            $max_length = max($max_length, strlen($body_row->getCells()[$col] ?? ''));
        }

        return $max_length;
    }

    public function render(array $options = []): string
    {
        return $this->renderSimple();
    }

    public function renderSimple()
    {
        $output = '';

        $max_col_lengths = [];

        foreach ($this->header_rows as $header_row) {
            foreach ($header_row->getHeaders() as $col => $header) {
                $max_col_lengths[$col] = $this->getMaxCellLengthForColumn($col);
            }
        }

        // Append '=' character for each max_col_lengths value (repeat) with two spaces in between each column
        $output .= implode('  ', array_map(static function ($length) {
            return str_repeat('=', $length);
        }, $max_col_lengths));

        $output .= "\n";

        // append headers; aligning each header to the start of the column
        $header_row = implode('  ', array_map(static function ($header, $length) {
            return str_pad($header, $length, ' ', STR_PAD_RIGHT);
        }, $this->header_rows[0]->getHeaders(), $max_col_lengths));

        $output .= trim($header_row) . "\n";

        // append '-' character for each max_col_lengths value (repeat) with two spaces in between each column
        $output .= implode('  ', array_map(static function ($length) {
            return str_repeat('-', $length);
        }, $max_col_lengths));

        $output .= "\n";

        // append body rows; aligning each cell to the start of the column
        foreach ($this->body_rows as $body_row) {
            $row = implode('  ', array_map(function ($cell, $length) {
                return str_pad($cell, $length, ' ', STR_PAD_RIGHT);
            }, $body_row->getCells(), $max_col_lengths));

            $output .= trim($row) . "\n";
        }

        // append '-' character for each max_col_lengths value (repeat) with two spaces in between each column
        $output .= implode('  ', array_map(function ($length) {
            return str_repeat('=', $length);
        }, $max_col_lengths));

        return $output;
    }
}
