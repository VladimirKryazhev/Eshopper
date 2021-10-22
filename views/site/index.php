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


                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <div class="cycle-slideshow"
                         data-cycle-fx=carousel
                         data-cycle-timeout=10000
                         data-cycle-carousel-visible=3
                         data-cycle-carousel-fluid=true
                         data-cycle-slides="div.item"
                         data-cycle-prev="#prev"
                         data-cycle-next="#next"
                    >
                        <?php foreach ($sliderProducts as $sliderItem): ?>
                            <div class="item">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo Product::getImage($sliderItem['id']); ?>" alt="" />
                                            <h2>$<?php echo $sliderItem['price']; ?></h2>
                                            <a href="/product/<?php echo $sliderItem['id']; ?>">
                                                <?php echo $sliderItem['name']; ?>
                                            </a>
                                            <br/><br/>
                                            <a href="#" class="btn btn-default add-to-cart" data-id="<?php echo $sliderItem['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                        </div>
                                        <?php if ($sliderItem['is_new']): ?>
                                            <img src="/template/images/home/new.png" class="new" alt="" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" id="next"  href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </div>
            </div><!--/recommended_items-->


            </div>
        </div>

</section>

<!--footer-->

<?php include ROOT . '/views/layouts/footer.php'; ?>
<!--/footer-->



