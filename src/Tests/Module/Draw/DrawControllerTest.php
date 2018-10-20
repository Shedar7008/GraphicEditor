<?php
use PHPUnit\Framework\TestCase;
use Shop\Module\Draw\DrawController;

class DrawControllerTest extends TestCase
{
    public function listTest()
    {
        $shape = ShapeFactory::factory($className, $params);
        $result = $shape->draw();
        return $result;

        $this->assertInstanceOf(ShapeFactory::factory, $user);


        $title = '';
        $userController = new UserController();
        $html = $userController->register($title);
        // have set some title
        $this->assertTrue(!empty($title));
        // have returned some page html
        $this->assertTrue(!empty($html));
    }
}