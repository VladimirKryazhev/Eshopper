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
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?=Product::getImage($product['id']); ?>" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->

                                <?php if ($product['is_new']): ?>
                                    <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                <?php endif; ?>



                                <h2><?=$product['name'];?></h2>
                                <p>Код товара: <?=$product['code'];?></p>
                                <span>
                                            <span>US $<?=$product['price'];?></span>

                                    <a href="#" data-id="<?= $product['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>

                                <p><b>Наличие:</b> На складе</p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> D&amp;G</p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p><?=$product['description'];?></p>

                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>


<br/>
<br/>

<!--Footer-->

<?php include ROOT . '/views/layouts/footer.php'; ?>

<!--/Footer-->




