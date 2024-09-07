<?php
require 'conectdb.php';
$id = $_POST['idproduct'];
$products = mysqli_query($conn,"SELECT * FROM `products` WHERE id_products = $id");
$img_pr = mysqli_fetch_array($products);



if(isset($_POST['update'])){
    $id = $_POST['idproduct'];
    $nameproduct = $_POST['nameproduct'];
    $nameimg = $_FILES['nameimg']['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $discount = $_POST['discount'];
    $category_id = $_POST['category_id'];
    if(empty($nameimg)){
        $nameimg = $img_pr[2];
    }

    $updatequery = "UPDATE products SET name_product='$nameproduct', Img='$nameimg', description='$description', cost='$cost', discount_ammount='$discount', category_id='$category_id' WHERE id_products='$id'";
    
    if(mysqli_query($conn, $updatequery)){
        echo "<script>
        alert (\"Данные обновлены!\");
        location.href='adminProduct.php'
        </script>";
    }else{
        echo "Ошибка: " . mysqli_error($conn);
    }
}

if(isset($_POST['delete'])){
    $id = $_POST['idproduct'];

    $deletequery = "UPDATE products SET statusproduct_id = 2 WHERE id_products=$id";
    
    if(mysqli_query($conn, $deletequery)){
        echo "<script>
        alert (\"Продукт успешно удален!\");
        location.href='adminProduct.php'
        </script>";
    }else{
        echo "Ошибка: " . mysqli_error($conn);
    }

}

if(isset($_POST['require'])){
    $id = $_POST['idproduct'];

    $deletequery = "UPDATE products SET statusproduct_id = 1 WHERE id_products=$id";
    
    if(mysqli_query($conn, $deletequery)){
        echo "<script>
        alert (\"Продукт успешно восстановлен!\");
        location.href='adminProduct.php'
        </script>";
    }else{
        echo "Ошибка: " . mysqli_error($conn);
    }

}

?>