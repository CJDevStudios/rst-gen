<?php

namespace CJDevStudios\RSTGen\Components;

/**
 * A block of RestructuredText content.
 */
class Block
{

    /**
     * @var ComponentInterface[]
     */
    private array $components;

    public function __construct(array $components)
    {
        $this->components = $components;
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function addComponent(ComponentInterface $component): void
    {
        $this->components[] = $component;
    }

    public function render(): string
    {
        $output = '';
        foreach ($this->components as $component) {
            $output .= $component->render();
        }
        return $output;
    }
}
