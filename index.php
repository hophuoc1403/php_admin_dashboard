<?php
include "./layout/header.inc.php";

$getAllProduct = getData('product');
if(isset($_SESSION['productSearch'])){
    $productSearch = $_SESSION['productSearch'];

}
?>
    <header class="bg-dark py-5">
        <div class="container  px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop
                    of <?= isset($_SESSION['account']) ? $_SESSION['account']['name'] : "Public" ?></h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
            </div>
        </div>
    </header>


    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center flex-wra">
                <?php foreach ($getAllProduct as $value) : ?>
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top  objecfit-cover" src="./uploads/<?= $value['image'] ?>" alt="..."/>
                            <!-- Product details-->
                            <div class="card-body p-3  ">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $value['name'] ?></h5>
                                    <!-- Product price-->
                                    <span>$<?= $value['price'] ?> - $80.00</span>
                                    <p class="fw-bolder"><?= $value['description'] ?></p>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


<?php include "layout/footer.inc.php" ?>