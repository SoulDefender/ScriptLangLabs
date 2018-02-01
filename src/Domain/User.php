<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 05.11.2015
 * Time: 22:16
 */

namespace Reminder\Domain;


class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var boolean
     */
    private $neverNotify;

    /**
     * @var string
     */
    private $recoveryHash;

    /**
     * Constructor without parameters.
     */
    private function __construct() {

    }

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     * @param bool $status
     * @param bool $neverNotify
     * @return User
     */
    public static function fromData($id, $name, $email, $password, $status, $neverNotify, $recoveryHash)
    {
        $user = new User();
        $user->id = $id;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->status = $status;
        $user->neverNotify = $neverNotify;
        $user->recoveryHash = $recoveryHash;
        return $user;
    }

    /**
     * @return User
     */
    public static function blankUser() {
        return new User();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return boolean
     */
    public function isNeverNotify()
    {
        return $this->neverNotify;
    }

    /**
     * @param boolean $neverNotify
     */
    public function setNeverNotify($neverNotify)
    {
        $this->neverNotify = $neverNotify;
    }

    /**
     * @return string
     */
    public function getRecoveryHash()
    {
        return $this->recoveryHash;
    }

    /**
     * @param string $recoveryHash
     */
    public function setRecoveryHash($recoveryHash)
    {
        $this->recoveryHash = $recoveryHash;
    }

}
