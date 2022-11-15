<?php

if(isset($conn)){
    $categories = mysqli_query($conn,"select * from category");


}
?>


<a href="?page=category/add.php" type="button" class="btn btn-primary btn-block">Create New Category</a>

<table class="table">
    <thead>
    <tr>
        <th>numerical order</th>
        <th>Name</th>
        <th>Status</th>
        <th>Filter</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $key => $category): ?>
        <tr>
            <td scope="row"><?= $key+1 ?></td>
            <td><?= $category['name'] ?></td>
            <td><?= $category['status'] == 1 ? "Available" : "Unavailable" ?></td>
            <td>
                <a class="btn btn-primary" href="?page=category/update.php&id=<?= $category['id'] ?>">Update</a>
                <a class="btn btn-danger" href="?page=category/delete.php&id=<?= $category['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
