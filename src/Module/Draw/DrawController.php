<?php

namespace Shop\Module\Draw;

use Shop\Module\Draw\Exception\NotSupportedClassException;

class DrawController
{
    /**
     * @param string $className
     * @param array $params
     * @return array
     * @throws NotSupportedClassException
     */
    public function list(string $className, array $params)
    {
        $shape = ShapeFactory::factory($className, $params);
        $result = $shape->draw();
        return $result;
    }
}