<?php

namespace CJDevStudios\RSTGen;

use CJDevStudios\RSTGen\Components\Block;

/**
 * RestructuredText document.
 */
class Document
{

    /**
     * @var Block[]
     */
    private array $blocks;

    public function __construct(array $blocks = [])
    {
        $this->blocks = $blocks;
    }

    public function addBlock(Block $block): void
    {
        $this->blocks[] = $block;
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }

    public function render(): string {
        $output = '';
        foreach ($this->blocks as $block) {
            $block_render = $block->render();
            // Trim trailing newlines
            $block_render = rtrim($block_render);
            $output .= $block_render . "\n\n";
        }
        return $output;
    }

    public function renderToFile(string $filename, bool $overwrite = false): void
    {
        if (!$overwrite && file_exists($filename)) {
            throw new \RuntimeException('File already exists');
        }
        file_put_contents($filename, $this->render());
    }
}
