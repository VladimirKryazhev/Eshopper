<?php

include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';


class SiteController
{
    // Action для главной страницы
    public function actionIndex()
    {
        // Список категорий для левого меню
          $categories = array();
          $categories = Category::getCategoriesList();

          //Список последних товаров
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(6);

        // Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();


        //echo '<pre>';
        //print_r($categories);
        //echo '</pre>';
        //echo 'Список новостей';

        // Подключаем вид
        require_once (ROOT . '/views/site/index.php');
        return true;
    }



   //Action для страницы "Контакты"
    public function actionContact()
    {

        // Переменные для формы
        $userEmail = false;
        $userText = false;
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Отправляем письмо администратору
                $adminEmail = 'php.start@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
                //var_dump($result);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }

   // Action для страницы "О магазине"

    public function actionAbout()
    {
        // Подключаем вид
        require_once(ROOT . '/views/site/about.php');
        return true;
    }




}