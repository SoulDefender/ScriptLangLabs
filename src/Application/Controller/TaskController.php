<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 27.12.2015
 * Time: 18:33
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;
use Reminder\Application\Service\TaskService;

class TaskController extends Controller
{
    public function doGet(HttpRequest $req, HttpResponse $resp)
    {
        $id = $req->getParameter('id');
        if( $id == null) {
            $resp->sendError(HttpResponse::HTTP_BAD_REQUEST, HttpResponse::HTTP_BAD_REQUEST_MESSAGE);
            return;
        }
        $taskService = TaskService::gi();
        $task = $taskService->getTaskById($id);
        if($task == null) {
            $resp->sendError(HttpResponse::HTTP_NOT_FOUND, HttpResponse::HTTP_NOT_FOUND_MESSAGE);
            return;
        }
        $req->setAttribute('task', $task);
        $req->render('task.html.twig');
    }

    public function doPost(HttpRequest $req, HttpResponse $resp)
    {
        $id = $req->getParameter('id');
        $resolve = $req->getParameter('resolve');
        if( $id == null || $resolve == null) {
            $resp->sendError(HttpResponse::HTTP_BAD_REQUEST, HttpResponse::HTTP_BAD_REQUEST_MESSAGE);
            return;
        }
        $taskService = TaskService::gi();
        if($resolve == 'true') {
            $taskService->resolveTaskById($id);
        }
        $resp->sendRedirect('/');
    }
}
