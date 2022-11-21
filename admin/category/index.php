<?php

if(isset($conn)){
    $categories = mysqli_query($conn,"select * from category");
    $total = mysqli_num_rows($categories);
    $limit = 4;
    $total_page = ceil($total/$limit);
    $current_page = $_GET['p'] ?? 1;
    $start = ($current_page-1) * $limit;
    $categories = getData('category',0,$start,$limit);

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
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= $current_page == 1 ? "disable" : "" ?>">
            <a class="page-link" href="?page=category/index.php&p=<?= $current_page >  1 ? $current_page -1 : 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php for($i = 1;$i <= $total_page;$i++) {?>
            <li class="page-item <?= $i == $current_page ? 'active' : "" ?>"><a class="page-link" href="?page=category/index.php&p=<?= $i ?>"><?= $i ?></a></li>
        <?php } ?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
