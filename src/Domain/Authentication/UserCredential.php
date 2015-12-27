<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 05.11.2015
 * Time: 22:17
 */

namespace Reminder\Domain\Authentication;


class UserCredential
{

    private $email;

    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
