<?php

namespace Shop\Module\User;


use Shop\Core\Repository;

class UserRepository extends Repository
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'User';
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            'ID',
            'password',
            'name',
            'email',
        ];
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @param $userID
     */
    public function login($userID)
    {
        $_SESSION['userID'] = $userID;
    }

    public function logout()
    {
        unset($_SESSION['userID']);
    }

    /**
     * @return null|\Shop\Core\Entity
     */
    public function getUser()
    {
        if (!array_key_exists('userID', $_SESSION)) {
            return null;
        }

        $user = $this->getByID($_SESSION['userID']);

        return $user;
    }

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function hashPassword(string $email, string $password): string
    {
        return password_hash($email . $password, PASSWORD_DEFAULT);
    }
}