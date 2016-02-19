<?php
define('__ROOT__', dirname(__FILE__)); 
require_once __ROOT__.'/Rito.php';
require_once  __ROOT__.'/APIClass.class.php';
require_once  __ROOT__.'/ConcreteApi.php';
require_once  __ROOT__.'/class.Model.php';

global  $model;
$model = new Modello();

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}

?>