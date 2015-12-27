<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 16.11.2015
 * Time: 20:13
 */

namespace Reminder\Application\Service;


use Core\App;
use Core\Singleton;
use Reminder\Domain\User;
use Reminder\Infrastructure\SQLRepositories\SQLUserRepository;
use Reminder\Infrastructure\Utils\RecoveryPasswordHashGenerator;

class PasswordRecoveryService extends Singleton
{

    private $userRepository;

    /**
     * @var RecoveryPasswordHashGenerator
     */
    private $passwordHasher;

    public function __construct() {
        $this->passwordHasher = RecoveryPasswordHashGenerator::gi();
        $this->userRepository = new SQLUserRepository(App::gi()->db);
    }

    /**
     * @param User $user
     * @return string
     */
    public function generateRecoveryPasswordHash(User $user) {
        $hash = $this->passwordHasher->generateHashForPasswordRecovery($user->getEmail());
        if($this->userRepository->addRecoveryHashToUser($user, $hash)) {
            return $hash;
        }
        return null;
    }

    /**
     * @param string $hash
     * @return User
     */
    public function findUserByRecoveryHash($hash) {
        return $this->userRepository->findUserByRecoveryHashAndRemoveHash($hash);
    }

}
