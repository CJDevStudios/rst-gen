<?php

namespace CJDevStudios\RSTGen\Components\Inline;

use CJDevStudios\RSTGen\Components\ComponentInterface;

class Emphasis implements ComponentInterface
{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function render(array $options = []): string
    {
        return sprintf('*%s*', $this->text);
    }
}
