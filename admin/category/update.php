<?php

$errors = [];
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $current = mysqli_query($conn,"select * from category where id=$id");
    $current = mysqli_fetch_assoc($current);
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $status = $_POST['status'];
    if($name == "" ){
        $errors['name_err'] = "Name is required";
    }else {
        $all_cate = mysqli_query($conn,"select * from category where id != $id");
        foreach ($all_cate as $cate){
            if($name == $cate['name']) {
                $errors['name_err'] = "Name is duplicated";
                break;
            }
        }
    }
    if(empty($errors)){

        $updateCate = mysqli_query($conn,
            "update category set name='$name',status=$status where id=$id");
        var_dump($updateCate);
        if($updateCate){
            echo "<script>
    location.href = '?page=category/index.php';
</script>";
        }else {
            echo "error";
        }
    }
}

?>


<form action="" method="post">

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input value="<?= $current['name'] ?>" type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="name">
        <span class="text-danger"><?= isset($errors['name_err']) ? $errors['name_err'] : "" ?></span>
    </div>
    <div class="mt-5">
        <label for="exampleFormControlTextarea1" class="form-label">Status</label>
        <label for=""><input <?= $current['status'] == 1 ? "checked" : "" ?> type="radio" value="1" name="status" checked id="">Available</label>
        <label for=""><input <?= $current['status'] == 0 ? "checked" : "" ?> type="radio" value="0" name="status" id="">Unavailable</label>
    </div>
    <button name="submit" class="btn btn-success" type="submit">Update</button>
</form>
<a href="?page=category/index.php">Cancel</a>