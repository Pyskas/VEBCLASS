<header class="container">
        <article class="sec_one">
            <section class="logo_left">
                <p class="r70038">VEBCLASS</p>
            </section>
            <section class="center_sec">
                <a class="head_link" href="index.php">Главная</a>
                <div class='head_link'>
                    <?php
                    if($_COOKIE['idUser']){
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
<?php 
    require_once "conectdb.php"; 
    $UserID=$_COOKIE['idUser'];
    $query=mysqli_query($conn,"SELECT * FROM ListOrder  
    INNER JOIN Orders ON Orders.id_orders = ListOrder.id_order 
    INNER JOIN products ON products.id_products = ListOrder.id_products WHERE id_user = $UserID"); 
    $user_order = mysqli_fetch_all($query);
    $queryOrder=mysqli_query($conn,"SELECT * FROM Orders WHERE id_user = $UserID"); 
    $order=mysqli_fetch_all($queryOrder); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="order.css"> 
    <title>Заказы</title>
</head> 
<body> 
    <main class="container"> 
        <article class="Cart"> 
            <h1>История обучения курсам</h1> 
            <div class="cart_product"> 
                <?php foreach($order as $userord):?> 
                    <div> 
                        <p id="textSostav">Курс №: <?=$userord[0]?></p> 
                        <p>Стоимость курса: <?=$userord[4]?> руб.</p> 
                    </div> 
                    <p id="textSostav">Кол-во курсов</p> 
                    <div class="sostavOrder"> 
                        <?php foreach($user_order as $ord):?> 
                            <?php if($ord[1] == $userord[0]):?> 
                                <div> 
                                    <img src="/img/<?=$ord[11]?>" alt="продукт <?=$ord[10]?>"> 
                                    <p><?=$ord[10]?></p> 
                                    <p>Кол-во: <?=$ord[3]?> шт.</p> 
                                    <p>Стоимость: <?=$ord[13]?> руб.</p> 
                                </div>  
                            <?php endif;?> 
                        <?php endforeach;?> 
                    </div> 
                <?php endforeach;?> 
            </div> 
        </article> 
    </main> 
</body> 
</html>