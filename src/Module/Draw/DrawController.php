<?php

namespace GraphicEditor\Module\Draw;

use GraphicEditor\Module\Draw\Exception\NotSupportedClassException;

class DrawController
{
    /**
     * @param string $className
     * @param array $params
     * @return array
     * @throws NotSupportedClassException
     */
    public function drawShape(string $className, array $params)
    {
        $shape = ShapeFactory::factory($className, $params);
        $result = $shape->draw();
        return $result;
    }
}