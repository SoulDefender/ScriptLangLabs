<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 09.11.2015
 * Time: 21:21
 */

namespace Core;


class Controller extends Singleton
{
    public function service(HttpRequest $req, HttpResponse $resp) {
        if($req->getMethod() === 'GET') {
            $this->doGet($req, $resp);
        } else if($req->getMethod() === 'POST') {
            $this->doPost($req, $resp);
        } else {
            $resp->sendError(HttpResponse::HTTP_NOT_IMPLEMENTED, HttpResponse::HTTP_NOT_IMPLEMENTED_MESSAGE);
            die();
        }
    }

    public function doGet(HttpRequest $req, HttpResponse $resp) {
        $resp->sendError(HttpResponse::HTTP_NOT_IMPLEMENTED, HttpResponse::HTTP_NOT_IMPLEMENTED_MESSAGE);
    }

    public function doPost(HttpRequest $req, HttpResponse $resp) {
        $resp->sendError(HttpResponse::HTTP_NOT_IMPLEMENTED, HttpResponse::HTTP_NOT_IMPLEMENTED_MESSAGE);
    }
}
