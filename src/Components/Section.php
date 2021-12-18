<?php

namespace CJDevStudios\RSTGen\Components;

/**
 * RST Section
 */
class Section implements ComponentInterface
{

    private int $level;

    private string $title;

    public function __construct(string $title, int $level = 1)
    {
        $this->title = $title;
        $this->level = $level;
    }

    private static function getSectionChar(int $level): string
    {
        switch ($level) {
            case 1:
                return '#';
            case 2:
                return '*';
            case 3:
                return '=';
            case 4:
                return '-';
            case 5:
                return '^';
            default:
                return '"';
        }
    }

    public function render(array $options = []): string
    {
        $char = self::getSectionChar($this->level);

        $char_row = str_repeat($char, strlen($this->title));
        return ($this->level < 3 ? ($char_row . "\n") : '') . $this->title . "\n" . str_repeat($char, strlen($this->title)) . "\n\n";
    }
}
