<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
    $delete = mysqli_query($conn,"delete from product where  id = $id");

    $product = mysqli_query($conn,"select * from product where  id= $id");
    $product=mysqli_fetch_assoc($product);
    if($product['image'] != ''){
        unlink('../uploads/'.$product['image']);
    }

    if($delete){
        echo "<script>
    location.href = '?page=product/index.php';
</script>";
    }
