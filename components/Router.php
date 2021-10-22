<?php


class Router
{
   private $routes;

    public function __construct()
    {
        $routesPath= ROOT . '/config/routes.php';
        $this->routes = include ($routesPath); //присваеваем Свойству routes массив в котором хранятся маршруты
        //var_dump( $this->routes);
    }

    //Получить строку запроса через супгбМассив СЕРВЕР и РЕКВЕСТ УРИ а затем возвращаем ее
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    public function run()
    {
        //print_r($this->routes); //это свойство и в нем хранятся маршруты
        //echo 'Class Router, method run';

        //Получить строку запроса из метода описанного выше
        $uri = $this->getURI();
        //echo $uri;


        //Проверить наличие такого запроса в маршрутах routes.php.. $uriPattern это первая часть маршрута это по сути запрос, а Паз это вторая часть, это маршрут выполнения метода экшена. Маршркт указан в файле роутс.пхп
        foreach ($this->routes as $uriPattern => $path){
            //echo  '<br>';
            //echo 'path---' . $path. '<br>';
           // echo 'uriPattern---' . $uriPattern . '<br>';



            //Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)){
                //echo 'Строка запроса uri---' . $uri. '<br>';;
                //echo 'Первая часть маршрута uriPattern---' . $uriPattern . '<br>';
                //echo 'Маршрут экшена path---' . $path. '<br>';


                //Получаем внутренний путь из внешнего запроса описано в роутс.пхп news/view/4
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //echo '<br><br>Нужно сформировать: '.$internalRoute;


                //Определяем конроллер, экшн, парметры
                //Если есть совпадение то определить какой контроллер и action обрабатывают запрос
                //Для этого расчленяем роутс на две части первая к контроллеруу, а вторая часть к action. Например делится роутс news/index
                $segments = explode('/', $internalRoute);
               // echo '<pre>';
               //  print_r($segments);
                //echo '</pre>';

                //Получаем значение первого элемента из массива и забираем его из массива, например news. К нему добавляем вторую часть наименование Контроллер
                $controllerName = array_shift($segments).'Controller';
                //Теперь после слияния имени контроллера делаем первую букву строки заглавной именно так как пишется наименование Контроллера
                $controllerName = ucfirst($controllerName);
                //echo $controllerName;

                //Все то же самое делаем с наименованием Экшенов, но одним выражением. Помним что из массива $segments мы уже удалили news и следующим первым остался метод, например view. И array_shift работает с ним
                $actionName = 'action'.ucfirst(array_shift($segments));
                //echo $actionName;

                //echo '<br>controller name: '.$controllerName;
                //echo '<br>action name: '.$actionName;
                $parameters = $segments;
                //echo '<pre>';
                //var_dump($_SERVER['REQUEST_URI']);

                //print_r($segments);

                //Array
                //(
                //[0] => sport
                //[1] => 114)




                //Подключить файл класса-контроллера, сначало опред файл, который надо подключить через РУТ и контроллнейм(имя Класса), а затем проверяем есть ли такой файл и подключаем его
                //Помни что это все в цикле, те ищется и подключается один файл исходя из запроса в строке от пользователя
                //А уже в самом файле класса включаем экшин-метод..это ниже. Но вначале надо подключить необходимый файл с контроллером иначе экшн не запустится
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                    //echo $controllerFile;
                }


                //Запускаем экшн в подключенном файле
                //Создать объект, вызвать метод-action
                $controllerObject = new $controllerName;
                //$result = $controllerObject->$actionName($parameters); //Вызываем необходимый экшн для необходимого объекта в нем записано имя класса контроллера. Например НьюсКонтроллер и тогда срабатывает его метод
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);//переделали на более умную функцию, она вызывает экшн по имени контроллера и передает экшену массив с параметрами
                //echo $result;
                //echo gettype($result);
                if ($result !=null) {
                    break;
                }

            }

        }

    }


}