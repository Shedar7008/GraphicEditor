<?php

namespace Shop\Module\Draw;

use Shop\Module\Draw\Exception\NotSupportedClassException;

class ShapeFactory
{
    /**
     * @param string $shape
     * @param array $params
     * @return DrawInterface
     * @throws NotSupportedClassException
     */
    public static function factory(string $shape, array $params): DrawInterface
    {
        $className = ucfirst($shape);
        $className = "Shop\\Module\\Draw\\Draw$className";

        if (!class_exists($className)) {
            throw new NotSupportedClassException();
        }

        $matches = [];
        $impl = class_implements($className);
        foreach ($impl as $value)
        {
            if(preg_match("/DrawInterface/i", $value, $matches)) {
                break;
            }
        }

        if(empty($matches)){
            throw new NotSupportedClassException();
        }

        return new $className($params);
    }
}