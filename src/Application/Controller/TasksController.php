<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 27.12.2015
 * Time: 18:42
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;
use Reminder\Application\Service\TaskService;

class TasksController extends Controller
{
    public function doGet(HttpRequest $req, HttpResponse $resp)
    {
        $year = $req->getParameter('year');
        $month = $req->getParameter('month');
        $day = $req->getParameter('day');
        if($year == null || $month == null || $day == null) {
            $resp->sendError(HttpResponse::HTTP_BAD_REQUEST, HttpResponse::HTTP_BAD_REQUEST_MESSAGE);
            return;
        }
        $user = $req->getSession()->getAttribute('user');
        $taskService = TaskService::gi();
        $tasks = $taskService->getTasksForDate(new \DateTime($year.'-'.$month.'-'.$day), $user);
        $req->setAttribute('tasks', $tasks);
        $req->render('tasks.html.twig');
    }

}
