<?php

//set_include_path(get_include_path().PATH_SEPARATOR.'models'.PATH_SEPARATOR.'components'.PATH_SEPARATOR.'controllers');
//spl_autoload_extensions('.php');
//spl_autoload_register();

spl_autoload_register(function ($class_name) {

    $array_paths = array(

        '/models/',
        '/components/',
        '/controllers/',

    );



    foreach ($array_paths as $path){

        $path = ROOT. $path . $class_name . '.php';

        if(is_file($path)){

            include_once $path;

        }

    }

});


//Функция __autoload для автоматического подключения классов


/*function my_autoloader($class_name)
{
    // Массив папок, в которых могут находиться необходимые классы
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    // Проходим по массиву папок
    foreach ($array_paths as $path) {

        // Формируем имя и путь к файлу с классом
        $path = ROOT . $path . $class_name . '.php';

        // Если такой файл существует, подключаем его
        if (is_file($path)) {
            include_once $path;
        }
    }
  }*/



