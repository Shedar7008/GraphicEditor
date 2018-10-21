<?php

namespace GraphicEditor\Module\Draw;

use GraphicEditor\Module\Draw\Exception\IncorrectParametersException;
use GraphicEditor\Module\Draw\Exception\NotSupportedClassException;

class ShapeFactory
{
    /**
     * @param string $shape
     * @param array $params
     * @return DrawInterface
     * @throws NotSupportedClassException
     * @throws IncorrectParametersException
     */
    public static function factory(string $shape, array $params): DrawInterface
    {
        $className = ucfirst($shape);
        $className = "GraphicEditor\\Module\\Draw\\Draw$className";

        if (!class_exists($className)) {
            throw new NotSupportedClassException("Not supported shape class.");
        }

        $matches = [];
        $impl = class_implements($className);
        foreach ($impl as $value) {
            if (preg_match("/DrawInterface/i", $value, $matches)) {
                break;
            }
        }

        if (empty($matches)) {
            throw new NotSupportedClassException();
        }

        try{
            return new $className(...$params);
        }
        catch (\Error $e)
        {
            throw new IncorrectParametersException("Incorrect parameters for Circle.");
        }

    }
}