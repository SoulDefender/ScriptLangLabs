<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 12.11.2015
 * Time: 23:42
 */

namespace Reminder\Application\Controller;


use Core\App;
use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;
use Reminder\Application\Service\LoginService;
use Reminder\Application\Service\MailService;
use Reminder\Application\Service\PasswordRecoveryService;
use Reminder\Application\Service\UserService;
use Reminder\Domain\Authentication\UserCredential;

class PasswordRecoveryController extends Controller
{
    public function doGet(HttpRequest $req, HttpResponse $resp)
    {
        $session = $req->getSession();
        $req->setAttribute('errors', $session->getAttribute('errors'));
        $req->setAttribute('userCredentials', $session->getAttribute('userCredentials'));
        $session->removeAttribute('errors');
        $session->removeAttribute('userCredentials');
        $req->render('password_recovery.html.twig');
    }

    public function doPost(HttpRequest $req, HttpResponse $resp)
    {
        $userCredentials = new UserCredential($req->getParameter('email'), $req->getParameter('password'));
        $userService = UserService::gi();
        $errors = [];
        $session = $req->getSession();
        $user = $userService->findUserByEmail($userCredentials->getEmail());
        if($user === null) {
            $errors['email'] = 'Email is unknown!';
            $session->setAttribute('errors', $errors);
            $session->setAttribute('userCredentials', $userCredentials);
            $resp->sendRedirect('/password/recovery');
            return;
        }

        $recoveryService = PasswordRecoveryService::gi();
        $hash = $recoveryService->generateRecoveryPasswordHash($user);
        if($hash === null) {
            $resp->sendError(HttpResponse::HTTP_NOT_ACCEPTABLE, HttpResponse::HTTP_NOT_ACCEPTABLE_MESSAGE);
            return;
        }
        $mailService = new MailService(App::gi()->config);
        $mailService->sendMessage('reminder.admin@gmail.com', $user->getEmail(), 'Password recovery', "
            Recovery link: <a href='http://reminder/password/reset?recoveryHash=$hash'>http://reminder/password/reset?recoveryHash=$hash</a>
        ");
        $resp->sendRedirect('/email/sent');
    }
}
