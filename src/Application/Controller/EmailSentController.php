<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 16.11.2015
 * Time: 21:07
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;

class EmailSentController extends Controller
{
    public function doGet(HttpRequest $req, HttpResponse $resp)
    {
        $req->render('email_sent.html.twig');
    }
}
