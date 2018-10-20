<?php

namespace Shop\Module\Draw;

use Shop\Module\Draw\Exception\IncorrectParametersException;

class DrawSquare implements DrawInterface
{
    private $a;
    private $color;
    private $borderSize;

    /**
     * DrawCircle constructor.
     * @param array $params
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $a = (int)($params[0] ?? 0);
        $color = $params[1] ?? '';
        $borderSize = (int)($params[2] ?? 0);
        if (empty($a) || empty($color) || empty($borderSize)) {
            throw new IncorrectParametersException();
        }

        $this->a = $a;
        $this->color = $color;
        $this->borderSize = $borderSize;
    }

    public function draw(): array
    {
        return [2.3, 3.4];
    }
}