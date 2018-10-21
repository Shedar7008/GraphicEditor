<?php

namespace GraphicEditor\Tests\Module\Draw;

use GraphicEditor\Module\Draw\Exception\IncorrectParametersException;
use PHPUnit\Framework\TestCase;
use GraphicEditor\Module\Draw\DrawCircle;
use GraphicEditor\Module\Draw\DrawSquare;
use GraphicEditor\Module\Draw\Exception\NotSupportedClassException;
use GraphicEditor\Module\Draw\ShapeFactory;

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
        $expected1 = new DrawCircle(5, "red", 2);
        $expected2 = new DrawSquare(2, "blue", 3);
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
     * @throws IncorrectParametersException
     */
    public function testFactory($a, $b, $expected)
    {
        $result = $this->factory->factory($a, $b);
        $this->assertInstanceOf(get_class($expected), $result);
        $this->assertEquals($expected, $result);
    }

    /**
     * @throws NotSupportedClassException
     * @throws IncorrectParametersException
     */
    public function testFactoryException()
    {
        $this->expectException(NotSupportedClassException::class);
        $this->factory->factory("triangle", [5, "red", 2]);
    }
}