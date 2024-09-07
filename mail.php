<?php require_once "connect.php"; ?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="regist.css">
    <title>Autorization</title>
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
        <article class="fomrs">
            <form action="sendmessage.php" method="post">

                    <p class="regost">Обновление пароля</p>

               <div class="hern">

                    <p class="fname"></з>
                    <form action="sendmessage.php" method="post"> 
    <label for="email">Введите вашу почту:</label><br> 
    <input type="text" id="email" name="email" class="flname" required></input><br><br> 
    <input type="submit" class="next_button" value="Отправить"> 
</form>
                </div>
            </form>
        </article>
    </main>
</body>
