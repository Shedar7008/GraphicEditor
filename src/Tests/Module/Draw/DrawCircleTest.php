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
        return array(
            [[5, "red", 2], [1.2, 2.3, 3.4, 4.5]],
            [["2", "red", 5], [1.2, 2.3, 3.4, 4.5]]
        );
    }

    /**
     * @return array
     */
    public function drawCircleExceptionDataProvider()
    {
        return array(
            [["red", 2]],
            [["green", "red", 2]]
        );
    }

    /**
     * @dataProvider drawCircleDataProvider
     * @param $params
     * @param $expected
     * @throws Exception
     */
    public function testDrawCircle($params, $expected)
    {
        $circle = new DrawCircle($params);
        $result = $circle->draw();
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider drawCircleExceptionDataProvider
     * @param $params
     * @throws Exception
     */
    public function testDrawCircleException($params)
    {
        $this->expectException(IncorrectParametersException::class);
        new DrawCircle($params);
    }
}