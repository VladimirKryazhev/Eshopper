<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}layouts{$ds}header.php");?>

<!--/header-->
<section>
    <div class="container">
        <div class="row">

            <!--БЛОК САЙДБАРА СЛЕВА-->
            <?php
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
            require_once("{$base_dir}layouts{$ds}sidebar.php");?>
            <!--/БЛОК САЙДБАРА СЛЕВА-->


            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Лучшие предложения</h2>

                    <!--БЛОК КОНТЕНТ ЛУЧШИЕ ТОВАРЫ-->
                    <?php foreach ($categoryProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?=Product::getImage($product['id']); ?>" alt="" />
                                        <h2><?=$product['price'];?>$</h2>
                                        <p><a href="/product/<?=$product['id'];?>">
                                                ID:<?=$product['id'];?>,<?=$product['name'];?></a>
                                        </p>
                                        <a href="/cart/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?php echo $product['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_new']):?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div><!--features_items-->
                <!--/БЛОК КОНТЕНТ ЛУЧШИЕ ТОВАРЫ-->
                <div class="pagination-block">
                <!--Постраничная Навигация Пагинейшн-->
                <?=$pagination->get();?>
                </div>
            </div>
        </div>
    </div>
</section>

<!--footer-->
<?php //include  "./views/layouts/footer.php"?>
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}layouts{$ds}footer.php");
//var_dump($base_dir);
?>
<!--/footer-->




