<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 05.11.2015
 * Time: 22:15
 */

namespace Reminder\Infrastructure;


use Reminder\Domain\User;

interface UserRepository
{

    public function registerUser(User $user);

    public function findUserByEmail($email);

}
