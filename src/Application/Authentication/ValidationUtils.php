<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 05.11.2015
 * Time: 22:40
 */

namespace Reminder\Application\Authentication;


class ValidationUtils
{

    /**
     * @param string $str
     * @param int $length
     * @param string $fieldName
     * @param array $errors
     * @param string $errorMessage
     * @return bool
     */
    public static function validateStringLength($str, $length, $fieldName, &$errors, $errorMessage) {
        if(strlen($str) < $length) {
            $errors[$fieldName] = $errorMessage;
            return false;
        }
        return true;
    }

    /**
     * @param string $email
     * @param string $fieldName
     * @param array $errors
     * @param string $errorMessage
     * @return boolean
     */
    public static function validateEmail($email, $fieldName, &$errors, $errorMessage) {
        if( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[$fieldName] = $errorMessage;
            return false;
        }
        return true;
    }

}
