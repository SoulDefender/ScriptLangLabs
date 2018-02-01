<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 13.12.2015
 * Time: 11:36
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;
use Reminder\Application\Service\TaskService;
use Reminder\Domain\Task;

class NewTaskController extends Controller
{
    public function doGet(HttpRequest $req, HttpResponse $resp)
    {
        $req->render('new_task.html.twig');
    }

    public function doPost(HttpRequest $req, HttpResponse $resp)
    {
        $taskName = $req->getParameter('name');
        $taskDescription = $req->getParameter('description');
        $toDate = $req->getParameter('toDate');
        $endDate = new \DateTime($toDate);

        if($this->nullOrEmpty($taskName) || $this->nullOrEmpty($taskDescription)|| $this->nullOrEmpty($toDate)) {
            $resp->sendError(HttpResponse::HTTP_BAD_REQUEST, HttpResponse::HTTP_BAD_REQUEST_MESSAGE);
            return;
        }

        $taskService = TaskService::gi();
        $task = Task::blankTask();
        $task->setCreatorId($req->getSession()->getAttribute('user')->getId());
        $task->setName($taskName);
        $task->setDescription($taskDescription);
        $task->setEndTime($endDate);
        $id = $taskService->newTask($task);
        $resp->sendRedirect('/task?id=' . $id);
    }

    private function nullOrEmpty($field) {
        return $field == null || empty($field);
    }

}