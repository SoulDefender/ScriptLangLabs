<?php
namespace Reminder\Infrastructure\SQLRepositories;


use DateTime;
use PDO;
use Reminder\Domain\Task;
use Reminder\Domain\User;
use Reminder\Infrastructure\TaskRepository;

class SQLTaskRepository implements TaskRepository
{

    const INSERT_TASK_QUERY = 'INSERT INTO task VALUES(DEFAULT, :name, FROM_UNIXTIME(:endTime), :priority, :description, :creatorId, DEFAULT)';

    const UPDATE_TASK_STATUS_QUERY = 'UPDATE task SET status = 2 WHERE id = :id';

    const SELECT_TASKS_BY_USER_ID = 'SELECT * FROM task WHERE id_creator = ?';

    const SELECT_TASK_BY_USER_ID_AND_DATE = 'SELECT * FROM task WHERE id_creator = :creatorId AND end_time > FROM_UNIXTIME(:fromDate) AND end_time < FROM_UNIXTIME(:toDate) AND status = 1';

    const SELECT_TASK_BY_ID = "SELECT * FROM task WHERE id = ?";

    private $pdo;

    /**
     * SQLUserRepository constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addTask(Task $task)
    {
        try {
            $stmt = $this->pdo->prepare(static::INSERT_TASK_QUERY);
            $stmt->bindParam(':name', $task->getName());
            $stmt->bindParam(':endTime', $task->getEndTime()->getTimestamp());
            $stmt->bindParam(':priority', $task->getPriority());
            $stmt->bindParam(':description', $task->getDescription());
            $stmt->bindParam(':creatorId', $task->getCreatorId());
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return false;
    }

    public function getTaskById($id) {
        try {
            $stmt = $this->pdo->prepare(static::SELECT_TASK_BY_ID);
            if($stmt->execute([$id])) {
                if($row = $stmt->fetch()) {
                    return TaskExtractor::extractTask($row);
                }
            }
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return null;
    }

    public function getTaskByEndDateAndUserId(DateTime $endDate, $userId)
    {
        $user_tasks = [];
        try {
            $fromDate = $endDate->getTimestamp() + 3600;
            $toDate = $endDate->getTimestamp() + (3600 * 25);
            $stmt = $this->pdo->prepare(static::SELECT_TASK_BY_USER_ID_AND_DATE);
            $stmt->bindParam(':creatorId', $userId);
            $stmt->bindParam(':fromDate', $fromDate);
            $stmt->bindParam(':toDate', $toDate);
            if($stmt->execute()) {
                $rowTasks = $stmt->fetchAll();
                foreach($rowTasks as $row) {
                    array_push($user_tasks, TaskExtractor::extractTask($row));
                }
            }
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return $user_tasks;
    }

    public function getTasksByUser(User $user)
    {
        $user_tasks = [];
        try {
            $stmt = $this->pdo->prepare(static::SELECT_TASKS_BY_USER_ID);
            if($stmt->execute([$user->getId()])) {
                $rowTasks = $stmt->fetchAll();
                foreach($rowTasks as $row) {
                    array_push($user_tasks, TaskExtractor::extractTask($row));
                }
            }
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return $user_tasks;
    }

    public function resolveTaskById($id)
    {
        try {
            $stmt = $this->pdo->prepare(static::UPDATE_TASK_STATUS_QUERY);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(\PDOException $ex) {
            echo 'DB_Error: ' . $ex->getMessage();
        }
        return false;
    }
}