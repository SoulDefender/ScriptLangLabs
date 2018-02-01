<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 12.11.2015
 * Time: 23:41
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;

class LogoutController extends Controller
{
    public function doGet(HttpRequest $req, HttpResponse $resp)
    {
        $req->getSession()->invalidate();
        $resp->sendRedirect('/');
        return;
    }

}
