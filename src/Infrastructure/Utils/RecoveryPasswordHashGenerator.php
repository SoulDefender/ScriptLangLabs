<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 15.11.2015
 * Time: 16:56
 */

namespace Reminder\Infrastructure\Utils;


use Core\Singleton;

class RecoveryPasswordHashGenerator extends Singleton
{

    public function __construct() {
    }

    public function generateHashForPasswordRecovery($email) {
        $salt = uniqid(mt_rand(), true);
        $emailAndSalt = $email . ':' . $salt;
        return sha1($emailAndSalt);
    }

}
