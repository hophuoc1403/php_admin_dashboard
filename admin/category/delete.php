<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = mysqli_query($conn,"delete from category where  id = $id");

    if($delete){
        echo "<script>
    location.href = '?page=category/index.php';
</script>";
    }
}