<?php
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';


class ProductController
{
    public function actionView($productId)
    {
        // Список категорий для левого меню
        $categories = array();
        $categories = Category::getCategoriesList();

        // Получаем инфомрацию о товаре
        $product = Product::getProductById($productId);

        require_once (ROOT . '/views/product/view.php');
        return true;
    }

}