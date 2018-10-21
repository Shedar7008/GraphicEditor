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
     * @param array $params
     * @throws IncorrectParametersException
     */
    public function __construct(array $params)
    {
        $radius = (int)($params[0] ?? 0);
        $color = $params[1] ?? '';
        $borderSize = (int)($params[2] ?? 0);

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