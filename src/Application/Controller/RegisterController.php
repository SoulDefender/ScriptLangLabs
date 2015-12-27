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
use Reminder\Application\Authentication\UserDataValidator;
use Reminder\Application\Service\RegistrationService;
use Reminder\Domain\User;

class RegisterController extends Controller
{

    public function doGet(HttpRequest $req, HttpResponse $resp) {
        $session = $req->getSession();
        $req->setAttribute('errors', $session->getAttribute('errors'));
        $req->setAttribute('user', $session->getAttribute('user'));
        $session->removeAttribute('errors');
        $session->removeAttribute('user');
        $req->render('register.html.twig');
    }

    public function doPost(HttpRequest $req, HttpResponse $resp)
    {
        $user = User::blankUser();
        $user->setName($req->getParameter('name'));
        $user->setEmail($req->getParameter('email'));
        $user->setPassword($req->getParameter('password'));
        $errors = [];
        if(!UserDataValidator::validate($user, $errors)) {
            $session = $req->getSession();
            $session->setAttribute('errors', $errors);
            $session->setAttribute('user', $user);
            $resp->sendRedirect('/register');
            return;
        }
        $registrationService = RegistrationService::gi();
        $registrationService->register($user);
        $resp->sendRedirect('/');
    }

}
