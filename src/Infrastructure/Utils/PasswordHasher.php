<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 05.11.2015
 * Time: 22:21
 */

namespace Reminder\Infrastructure\Utils;


use Core\Singleton;

class PasswordHasher extends Singleton
{

    public function hashPassword($password) {
        $salt = uniqid(mt_rand(), true);
        $passwordAndSalt = $password . ':' . $salt;
        return sha1($passwordAndSalt) . ':' . $salt ;
    }

    public function comparePasswords($originalPassword, $passedPassword) {
        $originalPasswordAndSalt = explode(':', $originalPassword);
        $hashedPassedPassword = sha1($passedPassword . ':' . $originalPasswordAndSalt[1]);
        return $originalPasswordAndSalt[0] === $hashedPassedPassword;
    }
}
