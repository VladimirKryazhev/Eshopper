<?php


class Product
{
    const SHOW_BY_DEFAULT = 6;
    //Возвращает массив последних товаров, те ВСЕХ
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = $page * $count;

        // Соединение с БД
        $db = Db::getConnection();
        $productsList = array();

        $query = "SELECT `id`, `name`, `price`, `is_new`, `images` FROM `product` WHERE `status`='1' ORDER BY `id` DESC LIMIT $count OFFSET $offset";
        $result = $db->query($query);

        // Указываем, что хотим получить данные в виде массива
         //$result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение команды
       // $result->execute();

        // Получение и возврат результатов
        $i = 0;
            while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['images'] = $row['images'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }



    //Возвращает массив товаров products в указанной КАТЕГОРИИ
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId){

            $limit = Product::SHOW_BY_DEFAULT;

            $page = intval($page);
            // Смещение (для запроса)
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $products =array();
            $query = "SELECT `id`, `name`, `price`, `images`,`is_new`  FROM `product` WHERE `status`='1' AND `category_id` = $categoryId ORDER BY `id` ASC LIMIT $limit OFFSET $offset";
            $result = $db->query($query);
            // Используется подготовленный запрос
            $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':limit', $limit, PDO::PARAM_INT);
            $result->bindParam(':offset', $offset, PDO::PARAM_INT);

            // Выполнение коменды
            $result->execute();

            $i=0;
            while ($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['images'] = $row['images'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }
            return $products;
        }
    }


    //Возвращает продукт с указанным id
    public  static function getProductById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = Db::getConnection();
            $query = "SELECT * FROM `product` WHERE `id`=" . $id;
            $result = $db->query($query);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }


    //Возвращает тотал товаров для пагинации
    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();
        $query = "SELECT count(`id`) AS count FROM `product` WHERE `status`='1' AND `category_id` = $categoryId ";
        $result = $db->query($query);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }


    //Возвращает список товаров с указанными индентификторами
    public static function getProdustsByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM product WHERE `status`='1' AND `id` IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }


//Возвращает список рекомендуемых товаров
    public static function getRecommendedProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query("SELECT `id`, `name`, `price`, `is_new` FROM product WHERE `status` = '1' AND `is_recommended` = '1' ORDER BY `id` DESC");
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }



//Возвращает путь к изображению
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/template/images/upload/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }



    //Возвращает список товаров
    public static function getProductsList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query("SELECT `id`, `name`, `price`, `code` FROM product ORDER BY `id` ASC");
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    //Удаляет товар с указанным id
    public static function deleteProductById($id)
    {

        $db = Db::getConnection();

        $sql = "DELETE FROM product WHERE `id` = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

     //Редактирует товар с заданным id
    public static function updateProductById($id, $options)
    {

        $db = Db::getConnection();

        $sql = "UPDATE product SET `name` = :name, `code` = :code, `price` = :price, `category_id` = :category_id, `brand` = :brand, `availability` = :availability, `description` = :description, `is_new` = :is_new, `is_recommended` = :is_recommended, `status` = :status WHERE `id` = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    // Добавляет новый товар
    public static function createProduct($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "INSERT INTO product (`name`, `code`, `price`, `category_id`, `brand`, `availability`,`description`, `is_new`, `is_recommended`, `status`) VALUES (:name, :code, :price, :category_id, :brand, :availability, :description, :is_new, :is_recommended, :status)";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    //Возвращает текстое пояснение наличия товара 0 - Под заказ, 1 - В наличии
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }



}

