<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 09.11.2015
 * Time: 21:37
 */

namespace Core;


class Model
{
    private $data = array();
    function __construct($data = array()) {
        $this->data = $data;
    }
    function __get($name){
        return isset($this->data[$name])?$this->data[$name]:null;
    }
    function __set($name,$value){
        $this->data[$name] = $value;
    }
}
