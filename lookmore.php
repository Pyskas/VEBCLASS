<?php
session_start();
require_once "conectdb.php";
if(!empty($_COOKIE['idUser'])){
    require_once "role.php"; 
};
$query= mysqli_query($conn,"SELECT * FROM products 
INNER JOIN categories ON categories.category_id = products.category_id 
ORDER BY id_products");
$list_products= mysqli_fetch_all($query);
$products_cart="SELECT * FROM products order by products.id_products;";
$categoryquery = mysqli_query($conn, "SELECT * FROM categories");
$category = mysqli_fetch_all($categoryquery);
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category'])) {
    $category_id = $_POST['category'];

    if($category_id == 'all') {
        if(isset($_POST['sort']) && $_POST['sort'] == 'ASC'){
            $query = mysqli_query($conn,"SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id ORDER BY cost ASC");
        } elseif(isset($_POST['sort']) && $_POST['sort'] == 'DESC'){
            $query = mysqli_query($conn,"SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id ORDER BY cost DESC");
        } else {
            $query = mysqli_query($conn,"SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id ORDER BY id_products");
        }
    } else {
        if(isset($_POST['sort']) && $_POST['sort'] == 'ASC'){
            $query = mysqli_query($conn, "SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id WHERE products.category_id = $category_id ORDER BY cost ASC");
        } elseif(isset($_POST['sort']) && $_POST['sort'] == 'DESC'){
            $query = mysqli_query($conn, "SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id WHERE products.category_id = $category_id ORDER BY cost DESC");
        } else {
            $query = mysqli_query($conn, "SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id WHERE products.category_id = $category_id ORDER BY id_products");
        }
    }
    $list_products = mysqli_fetch_all($query);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="./styles.css">
  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
<link rel="manifest" href="/favicon/site.webmanifest">
<link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

    <title>VEBCLASS</title>
</head>

<body>
    <header class="container">
        <article class="sec_one">
            <section class="logo_left">
                <p class="r70038">VEBCLASS</p>
            </section>
            <section class="center_sec">
                <a class="head_link" href="index.php">Главная</a>
                <div class='head_link'>
                    <?php
                    $roleid = $_COOKIE['roles'] ?? null;    
                    if( !empty($_COOKIE['idUser']) && $roleid != 2){
                    echo "<a class='head_link' href='/account.php'>Профиль</a>";
                    }else{
                    echo "<a class='head_link' href='/autorization.php'>Авторизация</a>";
                    }
                    ?>
                </div>
                <a class="head_link" href="reg.php">Регистрация</a>
                    <div class='head_link'>
                    <?php
                    if(!empty($_COOKIE['idUser'])){
                    echo "<a class='head_link' href='orders.php'>Курсы</a>";
                    }else{
                    echo " ";
                    }
                    ?>
                    </div>
                    <div class='head_link'>
                    <?php
                    $roleid = $_COOKIE['roles'] ?? null;
                    if($roleid == 2){
                        echo "<a class='head_link' href='adminPanel.php'>AdminDb</a>";
                    }else{
                        echo " ";
                    }
                    ?>
                    </div>
            </section>
            <section class="right_sec">
                <div class="d1">
                    <form>
                        <input type="text">
                        <button type="submit"><img class="search" src="/img/Search_Icon.svg" alt="search"></button>
                    </form>
                </div>
                <button class="cart_btn">
                    <img src="/img/Cart_Icon.svg" alt="cart">
                    <a class="cart" href="#demo-2-bottom" id="demo-2-top">Курсы</a>
                </button>
            </section>
        </article>
    </header>
<main class="container">
        <article class="sec_four">
            <p class="yel40036_two" a href="#demo-2-top" id="demo-2-bottom" >VEBCLASS </p>
            <p class="rob80050">Наши Курсы</p>
                    <form method="post">
            <label for="category" >Выберите категорию:</label>
            <select name="category" id="category" class="rob20700">
                <option value="all" <?php if(isset($_POST['category']) && $_POST['category'] == 'all') echo 'selected'; ?>>Все категории</option>
                <?php foreach ($category as $category_item): ?>
                    <option value="<?= $category_item[0]; ?>" <?php if(isset($_POST['category']) && $_POST['category'] == $category_item[0]) echo 'selected'; ?>><?= $category_item[1]; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="sort" id="1" class="rob20700">
                <option <?php if(!isset($_POST['sort']) || (isset($_POST['sort']) && $_POST['sort'] == 'ASC')) echo 'selected'; ?>>По умолчанию</option>
                <option value="ASC" <?php if(isset($_POST['sort']) && $_POST['sort'] == 'ASC') echo 'selected'; ?>>По возрастанию</option>
                <option value="DESC" <?php if(isset($_POST['sort']) && $_POST['sort'] == 'DESC') echo 'selected'; ?>>По убыванию</option>
            </select>
            <button type="submit" class="rob20700" >Применить фильтр</button>
                    </form>
                <!-- <button type="submit" name="ASC" value="ASC">По возрастанию</button>
                <button type="submit" name="DESC" value="DESC">По убыванию</button> -->
                <section class="up_down_boxes">
                    <section class="two_boxes">
                        <?php $count = 0; ?>
                        <?php foreach($list_products as $product): ?>
                            <?php if($count >= 8) break; ?> <!-- Проверка на количество выводимых элементов -->
                            <div class="Vegetables">
                                <div class="text_under">
                                    <button class="btn_veg">
                                        <a class="a_veg" href="#"><?= $product[9] ?></a>
                                    </button>
                                </div>
                                <div class="veg_img">
                                    <a href="add_to_cart.php?idProduct=<?= $product[0] ?>"> <img src="/img/<?= $product[2] ?>" alt="broccoli">
                                    </a>
                                </div>
                                <div class="text_under">
                                    <a href="add_to_cart.php" class="rob20700"><?= $product[1] ?></a>
                                </div>
                                <div class="line"></div>
                                <section class="price_star">
                                    <div class="price">
                                        <p class="os60015"><?= $product[4] ?>$</p>
                                        <p class="os60018"><?= $product[4] - ($product[4] * $product[5]) / 100 ?>$</p>
                                    </div>
                                    <img src="/img/Star.svg" alt="">
                                </section>
                            </div>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </section>
                </section>
