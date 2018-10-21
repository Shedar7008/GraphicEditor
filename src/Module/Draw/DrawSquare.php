<?php

namespace GraphicEditor\Module\Draw;

use GraphicEditor\Module\Draw\Exception\IncorrectParametersException;

class DrawSquare implements DrawInterface
{
    private $a;
    private $color;
    private $borderSize;

    /**
     * DrawSquare constructor.
     * @param int $a
     * @param string $color
     * @param int $borderSize
     * @throws IncorrectParametersException
     */
    public function __construct(int $a, string $color, int $borderSize)
    {
        if (empty($a) || empty($color) || empty($borderSize)) {
            throw new IncorrectParametersException("Incorrect parameters for Square.");
        }

        $this->a = $a;
        $this->color = $color;
        $this->borderSize = $borderSize;
    }

    /**
     * @return array
     */
    public function draw(): array
    {
        return [2.3, 3.4];
    }
}