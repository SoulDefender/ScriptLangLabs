<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 08.11.2015
 * Time: 13:35
 */

namespace Core;


class HttpSession
{

    public function __construct() {
    }

    /**
     * @param string $attrName
     * @return mixed
     * @throws \Exception
     */
    public function getAttribute($attrName) {
        return isset($_SESSION[$attrName]) ? unserialize($_SESSION[$attrName]) : null;
    }

    /**
     * @param $attrName
     * @param $attrValue
     * @throws \Exception
     */
    public function setAttribute($attrName, $attrValue) {
        $_SESSION[$attrName] = serialize($attrValue);
    }

    public function removeAttribute($attrName) {
        unset($_SESSION[$attrName]);
    }

    public function invalidate() {
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        session_destroy();
    }
}
