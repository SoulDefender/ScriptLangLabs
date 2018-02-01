<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 08.11.2015
 * Time: 13:32
 */

namespace Core;


class HttpRequest
{

    private $getParams;

    private $postParams;

    private $cookies;

    private $headers;

    private $twig;

    private $attributes;

    public function __construct($get, $post, $cookies, $headers, $twig) {

        $this->getParams = $get;
        $this->postParams = $post;
        $this->cookies = $cookies;
        $this->headers = $headers;
        $this->twig = $twig;
        $this->attributes = [];
    }

    public function setAttribute($attrName, $value) {
        $this->attributes[$attrName] = $value;
    }

    public function getAttribute($attrName) {
        return $this->attributes[$attrName];
    }

    /**
     * @param string $paramName
     */
    public function getParameter($paramName) {
        return $this->getParams[$paramName] ? $this->getParams[$paramName] :  $this->postParams[$paramName];
    }

    public function getSession() {
        return new HttpSession();
    }


    public function getHeaderParam($paramName) {
        return $this->headers ? $this->headers[$paramName] : null;
    }

    /**
     * @param string $cookieName
     * @return mixed
     */
    public function getCookie($cookieName) {
        return $this->cookies[$cookieName];
    }

    /**
     * @return string
     */
    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function render($viewName) {
        echo $this->twig->loadTemplate($viewName)->render([
            'param' => array_merge($this->getParams, $this->postParams),
            'requestScope' => $this->attributes
        ]);
    }
}
