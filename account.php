<?php
require "conectdb.php";

$UserID=$_COOKIE['idUser'];
$queryUserCheck = mysqli_query($conn, "SELECT * FROM `users` WHERE `id.user`=$UserID"); 
$user = mysqli_fetch_array($queryUserCheck);
$imgUser = $user["images"];
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Личный кабинет</title>
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
                    if($_COOKIE['idUser']){
                    echo "<a class='head_link' href='/account.php'>Профиль</a>";
                    }else{
                    echo "<a class='head_link' href='/autorization.php'>Авторизация</a>";
                    }
                    ?>
                </div>
                <a class="head_link" href="reg.php">Регистрация</a>
                <a class="head_link" href="lookmore.php">Курсы</a>
                <a class="head_link" href="orders.php">Обучение</a>
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
        
        <?php if(!empty($UserID)):?>
            <img class="img_profile" src="/img/<?=$imgUser?>" alt="<?=$imgUser?>">
        <?endif;?>
       
            <h1 class="">Привет, <?=$user["FIO"]?> </h1>
            <form action="update.php" method="post">
        <p> Аватар
            <input type="file" name="img" value="<?=$imgUser?>">
        </p>
        <p>ФИО
            <input type="text" name="FIO" value="<?=$user["FIO"]?>"></p>
        <p>Логин
            <input type="text" required name="login" value="<?=$user["login"]?>"></p>
        <p>Почта
            <input type="email" name="email" value="<?=$user["email"]?>"></p>
        <p>Пароль
            <input type="password" required name="password" value="<?=$user["password"]?>"></p>
        <input type="submit">
        </form>

        <form action="logout.php" method="post">
            <input type="submit" value="Выйти из аккаунта">
        </form>
        

    </main>
    
</body>
</html>