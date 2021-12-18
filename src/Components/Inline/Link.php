<?php

namespace CJDevStudios\RSTGen\Components\Inline;

use CJDevStudios\RSTGen\Components\ComponentInterface;

class Link implements ComponentInterface
{
    private $url;
    private $text;

    public function __construct($url, $text)
    {
        $this->url = $url;
        $this->text = $text;
    }

    public function render(array $options = []): string
    {
        return sprintf('`%s <%s>`_', $this->text, $this->url);
    }
}
