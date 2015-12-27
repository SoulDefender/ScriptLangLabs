<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 09.11.2015
 * Time: 23:02
 */

namespace Reminder\Application\Controller;


use Core\Controller;
use Core\HttpRequest;
use Core\HttpResponse;
use Reminder\Application\Service\LoginService;
use Reminder\Application\Service\UserService;
use Reminder\Domain\Authentication\UserCredential;

class LoginController extends Controller
{
    public function doGet(HttpRequest $request, HttpResponse $response) {
        $session = $request->getSession();
        $request->setAttribute('errors', $session->getAttribute('errors'));
        $request->setAttribute('userCredentials', $session->getAttribute('userCredentials'));
        $session->removeAttribute('errors');
        $session->removeAttribute('userCredentials');
        $request->render('login.html.twig');
    }

    public function doPost(HttpRequest $req, HttpResponse $resp)
    {
        $errorOccured = false;
        $userCredentials = new UserCredential($req->getParameter('email'), $req->getParameter('password'));
        $userService = UserService::gi();
        $errors = [];
        $session = $req->getSession();
        $user = $userService->findUserByEmail($userCredentials->getEmail());
        if($user === null) {
            $errorOccured = true;
            $errors['email'] = 'Email is unknown!';
        }
        if( !$errorOccured && ! $userService->checkPassword($userCredentials, $user)) {
            $errorOccured = true;
            $errors['password'] = 'Password is incorrect!';
        }
        if($errorOccured) {
            $session->setAttribute('errors', $errors);
            $session->setAttribute('userCredentials', $userCredentials);
            $resp->sendRedirect('/login');
            return;
        }
        $session->setAttribute('user', $user);
        $resp->sendRedirect('/');
    }

}
