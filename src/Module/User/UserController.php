<?php

namespace Shop\Module\User;


use Shop\Module\User\Exception\DuplicateUserException;
use Shop\Module\User\Exception\MissingParameterException;
use Shop\Module\User\Exception\PasswordsNotMatchException;
use Shop\Module\User\Exception\UserNotFoundException;
use Shop\Module\User\Exception\WrongPasswordException;

class UserController
{
    /**
     * @param string $title
     * @return string
     * @throws \Exception
     */
    public function register(string &$title)
    {
        if ($_POST) {
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $password2 = $_POST['password2'] ?? null;

            if (!$name) {
                throw new MissingParameterException('Name is required');
            }
            if (!$email) {
                throw new MissingParameterException('Email is required');
            }
            if (!$password) {
                throw new MissingParameterException('Password is required');
            }
            if ($password !== $password2) {
                throw new WrongPasswordException('Passwords does not match');
            }

            $userRepository = UserRepository::getInstance();
            $users = $userRepository->getAll(['email' => $email]);
            if ($users) {
                throw new DuplicateUserException('User with the same email already exists');
            }

            $hash = $userRepository->hashPassword($email, $password);

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($hash);

            $userID = $userRepository->addItem($user);
            $userRepository->login($userID);

            return 'Registration success';
        }

        $title = 'Register';
        $registerView = new RegisterView();
        $html = $registerView->fill();

        return $html;
    }

    /**
     * @param string $title
     * @return string
     * @throws \Exception
     */
    public function login(string &$title)
    {
        if ($_POST) {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$email) {
                throw new MissingParameterException('Email is required');
            }
            if (!$password) {
                throw new MissingParameterException('Password is required');
            }

            $userRepository = UserRepository::getInstance();
            $users = $userRepository->getAll(['email' => $email]);
            if (!$users) {
                throw new UserNotFoundException('User with this email was not found');
            }

            /** @var User $user */
            $user = $users[0];

            $hash = $userRepository->hashPassword($email, $password);
            if (password_verify($user->getPassword(), $hash)) {
                throw new PasswordsNotMatchException('Passwords does not match');
            }

            $userRepository->login($user->getID());

            return 'Authorization success';
        }

        $title = 'Login';
        $loginView = new LoginView();
        $html = $loginView->fill();

        return $html;
    }

    public function logout(string &$title)
    {
        $title = 'Logout';

        $userRepository = UserRepository::getInstance();
        $userRepository->logout();

        return 'Logout success';
    }
}