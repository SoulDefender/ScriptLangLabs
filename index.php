<?php
require_once 'vendor/autoload.php';
error_reporting(E_ERROR);
define('ROOT',dirname(__FILE__).'/');
define('CORE',dirname(__FILE__).'/core/');
define('APP',dirname(__FILE__).'/src/');
$factory = new CalendR\Calendar();
$loader = new \Twig_Loader_Filesystem('src/Presentation/twig_views/');
$twig = new \Twig_Environment($loader, array(
    'cache' => false
));
$twig->addExtension(new CalendR\Extension\Twig\CalendRExtension($factory));
\Core\App::gi()->start($twig, $factory);
