<?php

namespace Shop\Tests\Module\Draw;

use PHPUnit\Framework\TestCase;
use Shop\Module\Draw\DrawCircle;
use Shop\Module\Draw\DrawSquare;
use Shop\Module\Draw\Exception\IncorrectParametersException;
use Shop\Module\Draw\Exception\NotSupportedClassException;
use Shop\Module\Draw\ShapeFactory;

class ShapeFactoryTest extends TestCase
{
    /** @var ShapeFactory */
    private $factory;

    protected function setUp()
    {
        $this->factory = new ShapeFactory();
    }

    protected function tearDown()
    {
        $this->factory = null;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function factoryDataProvider()
    {
        $expected1 = new DrawCircle([5, "red", 2]);
        $expected2 = new DrawSquare([2, "blue", 3]);
        return array(
            ["circle", [5, "red", 2], $expected1],
            ["square", [2, "blue", 3], $expected2],
        );
    }

    /**
     * @dataProvider factoryDataProvider
     * @param $a
     * @param $b
     * @param $expected
     * @throws NotSupportedClassException
     */
    public function testFactory($a, $b, $expected)
    {
        $result = $this->factory->factory($a, $b);
        $this->assertInstanceOf(get_class($expected), $result);
        $this->assertEquals($expected, $result);
    }

    public function testFactoryException()
    {
        $this->expectException(NotSupportedClassException::class);
        $this->factory->factory("triangle", [5, "red", 2]);
    }

   /* public function testFactoryException2()
    {
        $this->expectException(IncorrectParametersException::class);
        $this->factory->factory("circle", ["red", 3, 2]);
    }*/

    /*public static function testFactory(string $shape, array $params): DrawInterface
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
    }*/
}