<?php
include "./layout/header.inc.php";

$name = isset($_GET['search']) ? $_GET['search'] : "";

if($name !== '') {

    $querySearch = mysqli_query($conn,"select * from product where name like '%$name%'");
    var_dump($querySearch);
        $_SESSION['productSearch'] = $querySearch;
}
?>

<div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center flex-wra">
                <?php foreach ($querySearch as $value) : ?>
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
    <a href="/shopping/index.php" class="btn btn-secondary">Back to Home</a>

<?php include "./layout/footer.inc.php"?>