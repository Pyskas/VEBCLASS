<?php 
require_once "conectdb.php"; 
 
if(isset($_COOKIE['idUser']) && isset($_POST["count"]) && isset($_POST['idProduct'])) { 
    $UserID = $_COOKIE['idUser']; 
    $count = (int)$_POST["count"]; 
    $idproduct = (int)$_POST['idProduct']; 
    $date = date('Y-m-d'); 
 
    // Fetch all products 
    $query = mysqli_query($conn, "SELECT * FROM products"); 
    $list_products = mysqli_fetch_all($query, MYSQLI_ASSOC); 
 
    // Insert a new order 
    $sql1 = "INSERT INTO Orders(id_user, DateOrder, id_product) VALUES ($UserID, '$date', '$idproduct')"; 
    if ($conn->query($sql1)) { 
        $last_id = $conn->insert_id; 
 
        // Check if product already exists in the order 
        $check_existing_product_sql = "SELECT * FROM ListOrder WHERE id_order = $last_id AND id_products = $idproduct"; 
        $existing_product = $conn->query($check_existing_product_sql); 
 
        if ($existing_product) { 
            if ($existing_product->num_rows > 0) { 
                // Update existing product count 
                $row = $existing_product->fetch_assoc(); 
                $existing_count = $row['count_product']; 
                $new_count = $existing_count + $count; 
 
                $update_sql = "UPDATE ListOrder SET count_product = $new_count WHERE id_order = $last_id AND id_products = $idproduct"; 
                var_dump($update_sql);
                if ($conn->query($update_sql)) { 
                    $id_order = $last_id; 
                } else { 
                    echo "Error updating list order!"; 
                } 
            } else { 
                // Insert new product into the order 
                $insert_sql = "INSERT INTO ListOrder(id_order, id_products, count_product) VALUES ($last_id, $idproduct, $count)"; 
                if ($conn->query($insert_sql)) { 
                    $id_order = $last_id; 
                } else { 
                    echo "Error adding product to list order!"; 
                } 
            } 
        } else { 
            echo "Error checking existing product: " . $conn->error; 
        } 
 
        // Display products 
    //     if (isset($id_order)) { 
    //         echo "<section class='two_boxes'>"; 
    //         foreach ($list_products as $product) { 
    //             echo " 
    //                 <div class='Vegetables'> 
    //                     <div class='text_under'> 
    //                         <button class='btn_veg'> 
    //                             <a class='a_veg' href='#'>{$product['column_name_8']}</a> 
    //                         </button> 
    //                     </div> 
    //                     <div class='veg_img'> 
    //                         <a href='add_to_cart.php?idProduct={$product['column_name_0']}'> 
    //                             <img src='/img/{$product['column_name_2']}' alt='brokoli'> 
    //                         </a> 
    //                     </div> 
    //                     <div class='text_under'> 
    //                         <a href='add_to_cart.php' class='rob20700'>{$product['column_name_1']}</a> 
    //                     </div> 
    //                     <div class='line'></div> 
    //                     <section class='price_sta'> 
    //                         <div class='price'> 
    //                             <p class='os60015'>$20.00</p> 
    //                             <p class='os60018'>$13.00</p> 
    //                         </div> 
    //                         <img src='/img/Star.svg' alt=''> 
    //                     </section> 
    //                 </div>"; 
    //         } 
    //         echo "</section>"; 
    //     } else { 
    //         echo "Error placing order!"; 
    //     } 
    // } else { 
    //     echo "Error creating order: " . $conn->error; 
    // } 
} 
    $UserID=$_COOKIE['idUser'];
    
    $queryUserCheck = mysqli_query($conn, "SELECT * FROM `users` WHERE `id.user`=$UserID"); 
    $user = mysqli_fetch_array($queryUserCheck);

    $product_search = mysqli_query($conn, 
    "SELECT products.name_product, products.description
    FROM `ListOrder` 
    JOIN products ON ListOrder.id_products = products.id_products
    WHERE `id_list`=$id_order");
    $product = mysqli_fetch_array($product_search);

    $name_product = $product['name_product'];
    $description = $product['description'];
    $email = $user['email'];
    
    mail("$email", "Спасибо за покупку", "Вы успешно купили курс $name_product, $description");

}
else { 
    echo "Required data not provided!"; 
} 
header("Location: orders.php")
?> 