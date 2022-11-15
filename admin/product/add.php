<?php

$errors = [];
$category = mysqli_query($conn, "select * from category");
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    $category_id = $_POST['category_id'];

    if ($name == "") {
        $errors['name_err'] = "Name is required";
    } else {
        $all_pro = mysqli_query($conn, "select * from product");
        foreach ($all_pro as $pro) {
            if ($name == $pro['name']) {
                $errors['name_err'] = "Name is duplicated";
                break;
            }
        }
    }

    if (!$price) {
        $errors['price_err'] = "Price is required";
    } else {
        if ($price <= 0)
            $errors['price_err'] = "Price must greater than 0";
    }
    if (!$desc)
        $errors['desc_err'] = "Description is required";

    if (!empty($_FILES['image']['name'])) {
        $file = $_FILES['image'];
        $file_name = time() . $file['name'];

        move_uploaded_file($file['tmp_name'], "uploads/" . $file_name);
    }

    var_dump($errors);
    if (empty($errors)) {

        $addCate = mysqli_query($conn,
            "INSERT INTO `product`( `name`, `price`, `sale_price`, `image`, `description`, `status`, `category_id`) VALUES 
                ('$name','$price','$sale','$file_name','$desc','$status','$category_id')");
        if ($addCate) {
            echo "<script>
    location.href = '?page=product/index.php';
</script>";
        } else {
            echo "error";
        }
    }


}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="name" value="<?= $_POST['name'] ?? "" ?>">
        <span class="text-danger"><?= $errors['name_err'] ?? "" ?></span>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Price</label>
        <input type="number" name="price" class="form-control" placeholder="price" value="<?= $_POST['price'] ?? "" ?>">
        <span class="text-danger"><?= $errors['price_err'] ?? "" ?></span>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Sale Price</label>
        <input type="text" name="sale" class="form-control" placeholder="sale" value="<?= $_POST['sale'] ?? "" ?>">
        <span class="text-danger"><?= $errors['sale_err'] ?? "" ?></span>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
        <span class="text-danger"><?= $errors['image_err'] ?? "" ?></span>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Description
            <input type="text" name="desc" class="form-control" placeholder="desc" value="<?= $_POST['desc'] ?? "" ?>">
        </label>
        <span class="text-danger"><?= $errors['desc_err'] ?? "" ?></span>
    </div>

    <div class="form-group">
        <label for="">Category</label>
        <select class="form-control" name="category_id" id="">
            <?php foreach ($category as $value): ?>
                <option value="<?= $value['id'] ?>" <?= $value['status'] == 0 ? "disabled" : "" ?>><?= $value['name']   ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mt-5">
        <label for="exampleFormControlTextarea1" class="form-label">Status</label>
        <label for=""><input type="radio" value="1" name="status" checked id="">Available</label>
        <label for=""><input type="radio" value="0" name="status" id="">Unavailable</label>
    </div>
    <button name="submit" class="btn btn-success" type="submit">Create</button>
</form>

<a href="?page=product/index.php">Cancel</a>