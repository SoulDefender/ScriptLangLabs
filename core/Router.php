<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 09.11.2015
 * Time: 20:51
 */

namespace Core;


class Router extends Singleton {

    public function parse($path) {
        $request = $_REQUEST;
        if(!isset($request['route'])) {
            $request['route'] = App::gi()->config->default_route;
        }
        $parts = parse_url($path);
        if (isset($parts['query']) and !empty($parts['query'])) {
            $path = str_replace('?'.$parts['query'], '', $path);
            parse_str($parts['query'], $req);
            $request = array_merge($request, $req);
        }

        foreach(app::gi()->config->routes as $route =>$controllerName) {
            if($request['route'] === $route) {
                return app::gi()->config->controllers[$controllerName];
            }
        }
        return null;
    }
}
