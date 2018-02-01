<?php

namespace Reminder\Infrastructure\SQLRepositories;


use PDO;
use Reminder\Domain\User;
use Reminder\Infrastructure\UserRepository;
use Reminder\Infrastructure\Utils\PasswordHasher;

class SQLUserRepository implements UserRepository
{

    const INSERT_USER_QUERY = 'INSERT INTO user VALUES(DEFAULT, :name, :email, :password, DEFAULT, DEFAULT, DEFAULT)';

    const SELECT_USER_BY_EMAIL = 'SELECT * FROM user WHERE email = ?';

    const SELECT_USER_BY_RECOVERY_HASH = 'SELECT * FROM user WHERE recoveryHash = ?';

    const UPDATE_USER_RECOVERY_HASH = 'UPDATE user SET recoveryHash = :recoveryHash WHERE id = :id';

    const UPDATE_USER_PASSWORD = 'UPDATE user SET password = :password WHERE id = :id';

    private $pdo;

    /**
     * SQLUserRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerUser(User $user)
    {
        try {
            $stmt = $this->pdo->prepare(static::INSERT_USER_QUERY);
            $stmt->bindParam(':name', $user->getName());
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':password', $user->getPassword());
            return $stmt->execute();
        } catch(\PDOException $ex) {
           echo 'DB_Error: ' . $ex->getMessage();
        }
        return false;
    }

    public function addRecoveryHashToUser(User $user, $recoveryHash) {
        try {
            $stmt = $this->pdo->prepare(static::UPDATE_USER_RECOVERY_HASH);
            $stmt->bindValue(':recoveryHash', $recoveryHash, PDO::PARAM_STR);
            $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return false;
    }

    public function findUserByEmail($email)
    {
        try {
            $stmt = $this->pdo->prepare(static::SELECT_USER_BY_EMAIL);
            if($stmt->execute([$email])) {
                if($row = $stmt->fetch()) {
                    return UserExtractor::extractUser($row);
                }
            }
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return null;
    }

    public function findUserByRecoveryHashAndRemoveHash($hash) {
        try {
            $stmt = $this->pdo->prepare(static::SELECT_USER_BY_RECOVERY_HASH);
            if($stmt->execute([$hash])) {
                if($row = $stmt->fetch()) {
                    $user = UserExtractor::extractUser($row);
                    $this->addRecoveryHashToUser($user, null);
                    return $user;
                }
            }
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return null;
    }

    public function updateUserPassword(User $user, $newPassword) {
        try {
            $stmt = $this->pdo->prepare(static::UPDATE_USER_PASSWORD);
            $stmt->bindValue(':password', $newPassword, PDO::PARAM_STR);
            $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return false;
    }
}
