<?php include ROOT . '/views/layouts/header.php'; ?>

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
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?=Product::getImage($product['id']); ?>" alt="" />
                                        <h2><?=$product['price'];?>$</h2>
                                        <p><a href="/product/<?=$product['id'];?>"><?=$product['name'];?></a></p>
                                        <a href="#" data-id="<?= $product['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
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

            </div>
        </div>
    </div>
</section>

<!--footer-->

<?php include ROOT . '/views/layouts/footer.php'; ?>
<!--/footer-->


