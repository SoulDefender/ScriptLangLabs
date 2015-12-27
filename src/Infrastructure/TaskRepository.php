<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 13.12.2015
 * Time: 11:38
 */

namespace Reminder\Infrastructure;


use DateTime;
use Reminder\Domain\Task;
use Reminder\Domain\User;

interface TaskRepository
{

    public function addTask(Task $task);

    public function getTaskByEndDateAndUserId(DateTime $endDate, $userId);

    public function getTasksByUser(User $user);

    public function resolveTaskById($id);

}
