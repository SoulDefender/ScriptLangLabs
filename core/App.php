<?php
/**
 * Created by PhpStorm.
 * User: Envy
 * Date: 09.11.2015
 * Time: 20:49
 */

namespace Core;


use CalendR\Calendar;

class App extends Singleton {

    public $config = null;

    /**
     * @var \Twig_Environment
     */
    public $twig = null;

    public $db = null;

    /**
     * @var Calendar
     */
    public $calendrFactory;

    function start($twig, $calendrFactory){
        $this->twig = $twig;
        $this->calendrFactory = $calendrFactory;
        $default_config = include CORE.'config.php';
        $custom_config = include APP.'config.php';
        $this->config = new Model(array_merge_recursive($default_config, $custom_config));
        $this->config->__set('calendr' , $this->calendrFactory);
        $this->db = DB::createPDO($this->config);
        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
            if((new \DateTime())->getTimestamp() - $_SESSION['START_TIME'] > app::gi()->config->session_expiration_time) {
                session_abort();
                session_destroy();
                session_start();
            }
            $_SESSION['START_TIME'] = (new \DateTime())->getTimestamp();
        }
        $twig->addGlobal("sessionScope", $_SESSION);
        $httpRequest = new HttpRequest($_GET, $_POST, $_COOKIE, headers_list(), $this->twig);
        $httpResponse = new HttpResponse();
        $controllerName = Router::gi()->parse($_SERVER['REQUEST_URI']);
        if($controllerName === null) {
            $httpResponse->sendError(HttpResponse::HTTP_NOT_FOUND, HttpResponse::HTTP_NOT_FOUND_MESSAGE);
        }
        $controller = app::gi($controllerName);
        $controller->service($httpRequest,$httpResponse);
    }
}
