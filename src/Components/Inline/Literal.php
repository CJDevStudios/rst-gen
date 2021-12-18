<?php

namespace CJDevStudios\RSTGen\Components\Inline;

use CJDevStudios\RSTGen\Components\ComponentInterface;

class Literal implements ComponentInterface
{

    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function render(array $options = []): string
    {
        return sprintf('``%s``', $this->text);
    }
}
