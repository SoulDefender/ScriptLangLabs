<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 05.11.2015
 * Time: 22:39
 */

namespace Reminder\Application\Authentication;


use Reminder\Domain\User;

class UserDataValidator
{

    /**
     * @param User $user
     * @param array $errors
     * @return bool
     */
    public static function validate(User $user, &$errors) {
        $result = true;
        $result = ValidationUtils::validateStringLength($user->getName(), 4, 'name', $errors,
                'User name must be longest that 3 symbols') && $result;
        $result = ValidationUtils::validateStringLength($user->getPassword(), 6, 'password', $errors,
                'Password must be longest that 5 symbols') && $result;
        $result = ValidationUtils::validateEmail($user->getEmail(), 'email', $errors, 'Email is incorrect') && $result;
        return $result;
    }

};