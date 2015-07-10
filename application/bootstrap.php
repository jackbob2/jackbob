<?php
/**
 * Bootstrap file
 * Get the URL and dispatch it with Router
 * Include also the doctrine and all libraries
 */

ini_set('memory_limit', '-1'); // maximum memory!

// start the session
session_start();
$check = "local";

if( $check == "local" || $check == "testing" )
{
 ini_set( "display_errors", "1" );
 error_reporting( E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
}
else
{
 error_reporting(0);
}

require_once "vendor/autoload.php" ;

// setting up the web root and server root for
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$uri = $_SERVER['REQUEST_URI'] ;
$phpSelf = trim($_SERVER['PHP_SELF']) ;
$webRoot = trim($_SERVER['SERVER_NAME']) ;

$tempUri = explode("index.php", $phpSelf) ;
if(count($tempUri) > 0) $uri = str_replace("/","",trim($tempUri[0])) ;

define('WEB_ROOT', $webRoot . $phpSelf);
define('SRV_ROOT', $srvRoot);
define('APP_PATH', $docRoot.'/'.$uri . '/');

if(floatval(phpversion()) < 5.4){
    if (!get_magic_quotes_gpc()) {
        if (isset($_POST)) {
            foreach ($_POST as $key => $value) {
                    if(is_array($value)) $value = implode(',', $value) ;
                    $_POST[$key] =  trim(addslashes($value));
            }
        }

        if (isset($_GET)) {
            foreach ($_GET as $key => $value) {
                    $_GET[$key] = trim(addslashes($value));
            }
        }
    }
}

//Add the required libraries

require_once(APP_PATH . "libraries/Error.class.php");
require_once(APP_PATH . "libraries/Router.php");
require_once(APP_PATH . "libraries/BaseController.class.php");
require_once(APP_PATH . "libraries/FrontController.class.php");
require_once(APP_PATH . "libraries/Doctrine.class.php");

// initialize the doctrine
Doctrine::initialize() ;

// create a new instance of FrontController
$frontController = new FrontController($_GET) ;
$request = $frontController ->getRequest() ;

// router and execute the action
$router = new Router($request) ;
$router -> dispatchAndExecute();

