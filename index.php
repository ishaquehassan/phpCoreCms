<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "tpl/head.php" ?>
</head>
<body>
<div class="master-container">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <span class="pull-left">18, Aug 2016</span>
                <div class="pull-right">
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Shipping</a>
                    <a href="#">FAQ's</a>
                    <a href="#">Contact</a>
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="container">
            <a href="#" class="pull-left logo">
                <img src="assets/images/logo.png" alt=""/>
            </a>
            <form action="#" method="get" class="header_search_form">
                <input type="search" name="search" value="" placeholder="Search Your Product..."/>
                <select name="category" title="Category">
                    <option value="">All Categories</option>
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                    <option value="3">Category 3</option>
                </select>
                <button type="submit" value="">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
            <div class="pull-right header_controls">
                <a href="#">
                    <i class="fa fa-compass" aria-hidden="true"></i>
                    <span>Track Order</span>
                </a>
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Login / Register</span>
                </a>
                <a href="#">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                    <span>Wishlist</span>
                </a>
                <a href="#" data-count="20">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <span>Cart</span>
                </a>
            </div>
        </div>
    </header>
    <nav>
        <div class="container">
            <a href="#">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                <span>Category 1</span>
            </a>
            <a href="#">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                <span>Category 1</span>
            </a>
            <a href="#">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                <span>Category 1</span>
            </a>
            <a href="#">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                <span>Category 1</span>
            </a>
        </div>
    </nav>
    <div class="container main-banners-container">
        <div class="main-banners">
            <a href="#">
                <img src="images/1.jpg" alt=""/>
            </a>
            <a href="#">
                <img src="images/2.jpg" alt=""/>
            </a>
        </div>
        <div class="mini-banners">
            <a href="#">
                <img src="images/m1.jpg" alt=""/>
            </a>
            <a href="#">
                <img src="images/m2.jpg" alt=""/>
            </a>
            <a href="#">
                <img src="images/m3.jpg" alt=""/>
            </a>
        </div>
    </div>

    <?php
    $categories = array(
        "Category 1",
        "Category 2",
        "Category 3",
        "Category 4",
    );
    ?>

    <div class="container">
        <?php foreach ($categories as $category) { ?>
            <div class="category_block">
                <div class="row block-header">
                    <div class="col-lg-12">
                        <h3><?= $category ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="block_banners col-lg-3">
                        <a href="#">
                            <img src="images/block-ban-1.jpg" alt=""/>
                            <div class="ban-titles">
                                <div class="center-block">
                                    <h3>Banner Title</h3>
                                    <p>Banner Sub Title</p>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <img src="images/block-ban-2.jpg" alt=""/>
                            <div class="ban-titles">
                                <div class="center-block">
                                    <h3>Banner Title</h3>
                                    <p>Banner Sub Title</p>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <img src="images/block-ban-3.jpg" alt=""/>
                            <div class="ban-titles">
                                <div class="center-block">
                                    <h3>Banner Title</h3>
                                    <p>Banner Sub Title</p>
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <img src="images/block-ban-4.jpg" alt=""/>
                            <div class="ban-titles">
                                <div class="center-block">
                                    <h3>Banner Title</h3>
                                    <p>Banner Sub Title</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="block_products_grid col-lg-9">
                        <div class="row block_products_grid_row">
                            <?php for ($p = 1; $p <= 8; $p++) { ?>
                                <a class="col-lg-3">
                                    <div class="grid_item" data-discount="10">
                                        <div class="img-block">
                                            <img src="images/p<?= $p ?>.jpg" alt=""/>
                                        </div>
                                        <div class="product-details">
                                            <h3>Product Title</h3>
                                            <p class="price">
                                                <span>Rs. 2000</span>
                                                <del>Rs. 2500</del>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <div class="recommended-products">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Recommended Products</h3>
                </div>
            </div>
            <div class="block_products_grid">
                <div class="row block_products_grid_row">
                    <?php for ($p = 1; $p <= 8; $p++) { ?>
                        <a class="col-lg-2">
                            <div class="grid_item" data-discount="10">
                                <div class="img-block">
                                    <img src="images/p<?= $p ?>.jpg" alt=""/>
                                </div>
                                <div class="product-details">
                                    <h3>Product Title</h3>
                                    <p class="price">
                                        <span>Rs. 2000</span>
                                        <del>Rs. 2500</del>
                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div  class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-3">

            </div>
            <div class="col-lg-3">

            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </footer>

</div>
</body>
</html>