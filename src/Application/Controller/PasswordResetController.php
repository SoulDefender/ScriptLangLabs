<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 16.11.2015
 * Time: 20:33
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;
use Reminder\Application\Service\PasswordRecoveryService;
use Reminder\Application\Service\UserService;

class PasswordResetController extends Controller
{

    public function doGet(HttpRequest $req, HttpResponse $resp)
    {
        $session = $req->getSession();
        if($session->getAttribute('userEmail') === null) {

            $recoveryHash = $req->getParameter('recoveryHash');
            $recoveryService = PasswordRecoveryService::gi();
            $user = $recoveryService->findUserByRecoveryHash($recoveryHash);
            if ($user == null) {
                $resp->sendError();
                return;
            }
            $session->setAttribute('userEmail', $user->getEmail());
        }
        $req->setAttribute('errors', $session->getAttribute('errors'));
        $session->removeAttribute('errors');
        $session->removeAttribute('userCredentials');
        $req->render('password_reset.html.twig');
    }

    public function doPost(HttpRequest $req, HttpResponse $resp)
    {
        $session = $req->getSession();
        if($session->getAttribute('userEmail') === null) {
            $resp->sendError(HttpResponse::HTTP_BAD_REQUEST, HttpResponse::HTTP_BAD_REQUEST_MESSAGE);
            return;
        }
        $password = $req->getParameter('password');
        $repeatPassword = $req->getParameter('repeatPassword');
        $errorOccured = false;
        $errors = [];
        if(strlen($password) < 6) {
            $errorOccured = true;
            $errors['password'] = 'Password should be greater than 5 chars';
        }
        if($password !== $repeatPassword) {
            $errorOccured = true;
            $errors['repeatPassword'] = 'Password not match!';

        }
        if($errorOccured) {
            $session->setAttribute('errors', $errors);
            $resp->sendRedirect('/password/reset');
            return;
        }
        $userService = UserService::gi();
        $user = $userService->findUserByEmail($session->getAttribute('userEmail'));
        $session->removeAttribute('userEmail');
        $userService->setPassword($user, $password);
        $resp->sendRedirect('/');
    }

}
