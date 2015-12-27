<?php


namespace Reminder\Infrastructure\SQLRepositories;


use Reminder\Domain\User;

class UserExtractor
{

    /**
     * @param $row
     * @return User
     */
    public static function extractUser($row) {
        return User::fromData(
            $row['id'], $row['name'], $row['email'], $row['password'], $row['status'], $row['never_notify'], $row['recoveryHash']
        );
    }
}
