<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 15.11.2015
 * Time: 15:41
 */

namespace Reminder\Application\Service;


use Core\App;
use Core\Singleton;
use Reminder\Domain\Authentication\UserCredential;
use Reminder\Domain\User;
use Reminder\Infrastructure\SQLRepositories\SQLUserRepository;
use Reminder\Infrastructure\Utils\PasswordHasher;

class UserService extends Singleton
{

    private $userRepository;

    /**
     * @var PasswordHasher
     */
    private $passwordHasher;

    public function __construct() {
        $this->passwordHasher = PasswordHasher::gi();
        $this->userRepository = new SQLUserRepository(App::gi()->db);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findUserByEmail($email) {
        return $this->userRepository->findUserByEmail($email);
    }

    /**
     * @param UserCredential $userCredential
     * @param User $user
     * @return bool
     */
    public function checkPassword(UserCredential $userCredential, User $user) {
        return $this->passwordHasher->comparePasswords($user->getPassword(), $userCredential->getPassword());
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function setPassword(User $user, $password) {
       return $this->userRepository->updateUserPassword($user, $this->passwordHasher->hashPassword($password));
    }

}
