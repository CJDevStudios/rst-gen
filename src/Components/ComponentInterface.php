<?php

namespace CJDevStudios\RSTGen\Components;

interface ComponentInterface
{

    /**
     * Convert the RST component to a source string
     * @param array $options
     * @return string
     */
    public function render(array $options = []): string;
}
