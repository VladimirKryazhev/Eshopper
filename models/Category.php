<?php

//Класс Category - модель для работы с категориями товаров
class Category
{
    //Возвращает массив категорий для списка на сайте
    public static function getCategoriesList()
    {
        $db = Db::getConnection();

        $query = "SELECT `id`, `name` FROM `category` WHERE `status`='1' ORDER BY `sort_order`";
        $result = $db->query($query);

        //$result = $db->query("SELECT `id`, `name` FROM `category` WHERE `status` = '1' ORDER BY `sort_order`");

        $i=0;
        $categoryList = array();
        while ($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;

    }

    // Возвращает массив категорий для списка в админпанели (при этом в результат попадают и включенные и выключенные категории)
    public static function getCategoriesListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $query = "SELECT `id`, `name`, `sort_order`, `status` FROM category ORDER BY `sort_order` ASC";
        $result = $db->query($query);

        // Получение и возврат результатов
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }


    // Удаляет категорию с заданным id
    public static function deleteCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $query = "DELETE FROM category WHERE `id` = :id";
        $result = $db->prepare($query);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    //Редактирование категории с заданным id
    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $query = "UPDATE category SET `name` = :name, `sort_order` = :sort_order, `status` = :status WHERE `id` = :id";
        $result = $db->prepare($query);

        // Получение и возврат результатов. Используется подготовленный запрос
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    //Возвращает категорию с указанным id
    public static function getCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $query = "SELECT * FROM category WHERE `id` =" . $id;
        $result = $db->query($query);

        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }

    // Возвращает текстое пояснение статуса для категории 0 - Скрыта, 1 - Отображается
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    // Добавляет новую категорию
    public static function createCategory($name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $query = "INSERT INTO category (`name`, `sort_order`, `status`) VALUES (:name, :sort_order, :status)";
        $result = $db->prepare($query);

        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }










}