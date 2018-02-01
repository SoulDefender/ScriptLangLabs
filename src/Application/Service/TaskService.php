<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 13.12.2015
 * Time: 11:37
 */

namespace Reminder\Application\Service;


use Core\App;
use Core\Singleton;
use Reminder\Domain\Task;
use Reminder\Domain\User;
use Reminder\Infrastructure\SQLRepositories\SQLTaskRepository;

class TaskService extends Singleton
{

    private $taskRepository;

    public function __construct() {
        $this->taskRepository = new SQLTaskRepository(App::gi()->db);
    }

    function newTask(Task $task) {
        return $this->taskRepository->addTask($task);
    }

    function getTasksForDate($date, User $user) {
        return $this->taskRepository->getTaskByEndDateAndUserId($date, $user->getId());
    }

    function getTaskById($id) {
        return $this->taskRepository->getTaskById($id);
    }

    function resolveTaskById($id) {
        return $this->taskRepository->resolveTaskById($id);
    }

}
