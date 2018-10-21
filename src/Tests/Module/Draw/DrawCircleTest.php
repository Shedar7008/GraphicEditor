<?php

namespace GraphicEditor\Tests\Module\Draw;

use Exception;
use PHPUnit\Framework\TestCase;
use GraphicEditor\Module\Draw\DrawCircle;
use GraphicEditor\Module\Draw\Exception\IncorrectParametersException;


class DrawCircleTest extends TestCase
{
    /**
     * @return array
     */
    public function drawCircleDataProvider()
    {
        return [
            [5, "red", 2, [1.2, 2.3, 3.4, 4.5]],
        ];
    }

    /**
     * @return array
     */
    public function drawCircleExceptionDataProvider()
    {
        return [
            [5, "red", 0]
        ];
    }

    /**
     * @return array
     */
    public function drawCircleErrorDataProvider()
    {
        return [
            [["green", "red", 5]],
            [["red", 5]]
        ];
    }

    /**
     * @dataProvider drawCircleDataProvider
     * @param $p1
     * @param $p2
     * @param $p3
     * @param $expected
     * @throws IncorrectParametersException
     */
    public function testDrawCircle($p1, $p2, $p3, $expected)
    {
        $circle = new DrawCircle($p1, $p2, $p3);
        $result = $circle->draw();
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider drawCircleExceptionDataProvider
     * @param $p1
     * @param $p2
     * @param $p3
     * @throws IncorrectParametersException
     */
    public function testDrawCircleException($p1, $p2, $p3)
    {
        $this->expectException(IncorrectParametersException::class);
        new DrawCircle($p1, $p2, $p3);
    }

    /**
     * @dataProvider drawCircleErrorDataProvider
     * @param array $params
     * @throws IncorrectParametersException
     */
    public function testDrawCircleError(array $params)
    {
        $this->expectException(\Error::class);
        new DrawCircle(...$params);
    }
}