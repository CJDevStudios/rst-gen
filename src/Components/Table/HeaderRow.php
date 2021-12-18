<?php

namespace CJDevStudios\RSTGen\Components\Table;

/**
 * Restructured Text Table Header Row
 */
class HeaderRow
{
    private $headers;

    public function __construct($headers = [])
    {
        $this->headers = $headers;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
