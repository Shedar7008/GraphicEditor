<?php

namespace GraphicEditor\Module\Draw;

use GraphicEditor\Module\Draw\Exception\IncorrectParametersException;

class DrawCircle implements DrawInterface
{
    private $radius;
    private $color;
    private $borderSize;

    /**
     * DrawCircle constructor.
     * @param int $radius
     * @param string $color
     * @param int $borderSize
     * @throws IncorrectParametersException
     */
    public function __construct(int $radius, string $color, int $borderSize)
    {
        if (empty($radius) || empty($color) || empty($borderSize)) {
            throw new IncorrectParametersException("Incorrect parameters for Circle.");
        }

        $this->radius = $radius;
        $this->color = $color;
        $this->borderSize = $borderSize;
    }

    /**
     * @return array
     */
    public function draw(): array
    {
        return [1.2, 2.3, 3.4, 4.5];
    }
}