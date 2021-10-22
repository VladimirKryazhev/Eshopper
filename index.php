<?php
//Front Controller

//1.Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//2.Подключение файлов системы
define("ROOT", dirname(__FILE__));
require_once (ROOT . '/components/Autoload.php');
//require_once (ROOT . '/components/Router.php');
//require_once (ROOT . '/components/Db.php');

//var_dump(ROOT);
//var_dump (__DIR__);
//var_dump (__FILE__);


//3.Установка соед с БД

//4.Вызов Router
$router = new Router();
$router->run();
