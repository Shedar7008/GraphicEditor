<?php

namespace Shop\Tests\Module\Draw;

use Exception;
use PHPUnit\Framework\TestCase;
use Shop\Module\Draw\DrawCircle;
use Shop\Module\Draw\Exception\IncorrectParametersException;


class DrawCircleTest extends TestCase
{
    /**
     * @return array
     * @throws Exception
     */
    public function drawCircleDataProvider()
    {
        return array(
            [[5, "red", 2], [1.2, 2.3, 3.4, 4.5]]
        );
    }

    public function drawCircleExceptionDataProvider()
    {
        return array(
            [["red", 2]],
            [["dddd", "red", 2]]
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
     * @throws Exception
     */
    public function testDrawCircleException($params)
    {
        $this->expectException(IncorrectParametersException::class);
        new DrawCircle($params);

    }

}