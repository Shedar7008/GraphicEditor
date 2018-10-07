<?php

namespace Shop\Tests\Module\User;

require __DIR__ . '/../../../../includes.php';

use PHPUnit\Framework\TestCase;
use Shop\Module\User\Exception\DuplicateUserException;
use Shop\Module\User\Exception\MissingParameterException;
use Shop\Module\User\Exception\WrongPasswordException;
use Shop\Module\User\User;
use Shop\Module\User\UserController;
use Shop\Module\User\UserRepository;

class UserControllerTest extends TestCase
{
    /** @var int */
    private $existingUserID;

    /** @var int */
    private $createdUserID;

    protected function setUp()
    {
        $userRepository = UserRepository::getInstance();

        // create a user for the duplicate user test
        $user = new User();
        $user->setName('name');
        $user->setEmail('existing_email');
        $hash = $userRepository->hashPassword('existing_email', 'password');
        $user->setPassword($hash);
        $this->existingUserID = $userRepository->addItem($user);
    }

    protected function tearDown()
    {
        $userRepository = UserRepository::getInstance();

        $userRepository->deleteItem($this->existingUserID);

        if ($this->createdUserID) {
            $userRepository->deleteItem($this->createdUserID);
        }
    }

    /** @test */
    public function registerTest()
    {
        $title = '';
        $userController = new UserController();
        $html = $userController->register($title);
        // have set some title
        $this->assertTrue(!empty($title));
        // have returned some page html
        $this->assertTrue(!empty($html));
    }

    /** @test */
    public function registerMissingParameterExceptionTest()
    {
        $this->expectException(MissingParameterException::class);
        $_POST['foo'] = 'bar';
        $title = '';
        $userController = new UserController();
        $userController->register($title);
    }

    /** @test */
    public function registerWrongPasswordException()
    {
        $this->expectException(WrongPasswordException::class);
        $_POST['name'] = 'name';
        $_POST['email'] = 'email';
        $_POST['password'] = 'password';
        $title = '';
        $userController = new UserController();
        $userController->register($title);
    }

    /** @test */
    public function registerDuplicateUserExceptionTest()
    {
        $this->expectException(DuplicateUserException::class);
        $_POST['name'] = 'name';
        $_POST['email'] = 'existing_email';
        $_POST['password'] = 'password';
        $_POST['password2'] = 'password';
        $title = '';
        $userController = new UserController();
        $userController->register($title);
    }

    /** @test */
    public function registerSuccessTest()
    {
        $_POST['name'] = 'name';
        $_POST['email'] = 'test_email';
        $_POST['password'] = 'password';
        $_POST['password2'] = 'password';
        $title = '';
        $userController = new UserController();
        $userController->register($title);

        $userRepository = UserRepository::getInstance();
        /** @var User $user */
        $user = $userRepository->getUser();
        $this->assertInstanceOf(User::class, $user);

        $this->createdUserID = $user->getID();
    }
}
