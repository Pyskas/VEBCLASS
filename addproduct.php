<?php
if (isset($_POST["nameproduct"]) && isset($_POST["nameimg"]) && isset($_POST["description"]) && isset($_POST["cost"]) && isset($_POST["discount"]) && isset($_POST["category_id"]) && isset($_POST["status_id"])) {
      
      require_once "conectdb.php";
  
      $nameproduct = $conn->real_escape_string($_POST["nameproduct"]);
      $nameimg = $conn->real_escape_string($_POST["nameimg"]);
      $description = $conn->real_escape_string($_POST["description"]);
      $cost = $conn->real_escape_string($_POST["cost"]);
      $discount = $conn->real_escape_string($_POST["discount"]);
      $category_id = $conn->real_escape_string($_POST["category_id"]);
      $status_id = $conn->real_escape_string($_POST["status_id"]);

      $newproduct = mysqli_query($conn,"INSERT INTO `products`(`name_product`, `Img`, `description`, `cost`, `discount_ammount`, `category_id`, `statusproduct_id`) VALUES ('$nameproduct','$nameimg','$description','$cost','$discount','$category_id','$status_id')");
      if($newproduct){
        echo "<script>
        alert(\"Успешно добавлен курс!\");
        location.href='adminProduct.php'
        </script>";
      }

}

      ?>