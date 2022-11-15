<?php

$errors = [];
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $status = $_POST['status'];
    if($name == "" ){
        $errors['name_err'] = "Name is required";
    }else {
        $all_cate = mysqli_query($conn,"select * from category");
        foreach ($all_cate as $cate){
            if($name == $cate['name']) {
                $errors['name_err'] = "Name is duplicated";
                break;
            }
        }
    }
    if(empty($errors)){

        $addCate = mysqli_query($conn,
            "insert into category(id,name,status) values (null,'$name',$status)");
        if($addCate){
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

        <input type="text" name="name" class="form-control"  placeholder="name" value="<?= isset($_POST['name']) ? $_POST['name'] : "" ?>">
        <span class="text-danger"><?= isset($errors['name_err']) ? $errors['name_err'] : "" ?></span>
    </div>
    <div class="mt-5">
        <label for="exampleFormControlTextarea1" class="form-label">Status</label>
        <label for=""><input type="radio" value="1" name="status" checked id="">Available</label>
        <label for=""><input type="radio" value="0" name="status" id="">Unavailable</label>
    </div>
    <button name="submit" class="btn btn-success" type="submit">Create</button>
</form>

<a href="?page=category/index.php">Cancel</a>