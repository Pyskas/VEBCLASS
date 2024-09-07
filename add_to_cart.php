<?php
session_start();
require_once "conectdb.php";

if(isset($_GET['idProduct'])){
$idProduct = $_GET['idProduct'];
$query= mysqli_query($conn,"SELECT * FROM products
INNER JOIN categories ON categories.category_id = products.category_id WHERE id_products=$idProduct ORDER BY id_products");
$list_products= mysqli_fetch_all($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="shop_single.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
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
                    if(isset($_COOKIE['idUser'])){
                    echo "<a class='head_link' href='/account.php'>Профиль</a>";
                    }else{
                    echo "<a class='head_link' href='/autorization.php'>Авторизация</a>";
                    }
                    ?>
                </div>
                <a class="head_link" href="reg.php">Регистрация</a>
                <a class="head_link" href="add_to_cart.php">Курсы</a>
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

    <main class="bg_shop_single">
        <p class="ss">Все курсы</p>
    </main>

    <main class="container">

    <?php if(isset($_GET['idProduct'])):
        $idProduct = $_GET['idProduct'];
        ?>
        <?php foreach($list_products as $product):?>
            <div class="products_cart">
                <div class="img_btn_shop">
            <button class="btn_veg_two">
                <a class="a_veg_two" href="#"><?=$product[8]?></a>
            </button>
                <img class="shop_single_img" src="/img/<?=$product[2]?>" alt="">
                </div>
                <div class="right_side_shop">
                    <div class="">
                <p class="name_prosuct"><?=$product[1]?></p>
                <img class="stars" src="/img/Star.svg" alt="staras">
                <div class="amount_prosucts">
                    <p class="os60015_two"><?=$product[4]?>.00</p>
                    <p class="os60018_two"><?=$product[4]-(($product[4]/100)*$product[5])?>.00</p>
                </div>
                </div>
                <p class="os40018_shop"><?=$product[3]?></p>
                <div>
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >
  Перейти к оплате
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <div class="wrapper">
    <form  class="mb-3" action="cart.php" method="post">
        <input type="text" name="" id="idProduct" value="<?=$idProduct?>" hidden>
    <input type="hidden" step="1" min="1" max="27" id="num_count" name="count" value="1" title="Кол." size="4">
        <input type="hidden" id="num_count" name="idProduct" value="<?=$idProduct?>">
      <div>
        <label for="name">ФИ(указано на карте)</label>
        <input required type="text" id="name" name="name" autocomplete="cc-name" required>
      </div>
     <div class="card-number">
        <label>Номер карты</label>
       <input required type="text" id="card-number" name="card-number" inputmode="numeric" autcomplete="cc-number" pattern="[0-9]+" required>
      </div>
      <div class="date-code"><div>
        <label for="expiry-date">Дата карты</label>
       <input required type="text" id="expiry-date" name="expiry-date" class="expiry-date" autocomplete="cc-exp" placeholder="MM/YY" minlength="4" pattern="[0-9/]+" required>
        </div>
        <div>
        <label for="security-code">Пин-код</label>
          <input required type="text" id="security-code" name="security-code" inputmode="numeric" minlength="3" maxlength="4" pattern="[0-9]+" required></div>
      </div>
      <div class="modal-footer">
      <input type="hidden" id="num_count" name="idProduct" value="<?=$idProduct?>">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="submit">Оплатить</button>
      </div>
    </form>
  </div>
      </div>
    </div>
  </div>
</div>
                </div>
                </div>
                
            </div>
        <?endforeach;?>
        <?endif;?>
    </main>
    
</body>
</html>