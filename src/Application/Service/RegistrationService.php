<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 15.11.2015
 * Time: 11:11
 */

namespace Reminder\Application\Service;


use Core\App;
use Core\Singleton;
use Reminder\Domain\User;
use Reminder\Infrastructure\SQLRepositories\SQLUserRepository;
use Reminder\Infrastructure\Utils\PasswordHasher;

class RegistrationService extends Singleton
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
     * @param User $user
     * @return bool
     */
    public function register(User $user) {
        $user->setPassword($this->passwordHasher->hashPassword($user->getPassword()));
        return $this->userRepository->registerUser($user);
    }
}
