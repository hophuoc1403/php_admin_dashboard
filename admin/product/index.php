<?php

if(isset($conn)){

    $products = mysqli_query($conn,"select product.*,category.name as 
    categoryName from product join category on product.category_id = category.id");


}
?>


<a href="?page=product/add.php" type="button"
   class="btn btn-primary btn-block">Create New Product</a>

<table class="table">
    <thead>
    <tr>
        <th>numerical order</th>
        <th>Name</th>
        <th>Price</th>
        <th>Sale Price</th>
        <th>Image</th>
        <th>Description</th>
        <th>Status</th>
        <th>Category</th>
        <th>Filter</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $key => $product): ?>
        <tr>
            <td scope="row"><?= $key+1 ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['sale_price'] == 0 ? "No Sale" : $product['sale_price'] ?></td>
            <td><img src="uploads/<?= $product['image'] ?>" style="width: 60px" alt=""></td>
            <td><?= $product['description'] ?></td>
            <td><?= $product['status'] == 1 ? "Available" : "Unavailable" ?></td>
            <td><?= $product['categoryName'] ?></td>
            <td>
                <a class="btn btn-primary" href="?page=product/update.php&id=<?= $product['id'] ?>">Update</a>
                <a class="btn btn-danger" href="?page=product/delete.php&id=<?= $product['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
