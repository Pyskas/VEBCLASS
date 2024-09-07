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
                    <?php
                    if($_COOKIE['idUser'] ?? null){
                    echo "<a class='head_link' href='/account.php'>Профиль</a>";
                    }else{
                    echo "<a class='head_link' href='/autorization.php'>Авторизация</a>";
                    }
                    ?>
                </div>
                <a class="head_link" href="reg.php">Регистрация</a>
                <a class="head_link" href="lookmore.php">Курсы</a>
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
            <form action="auto.php" method="post">

                    <p class="regost">Авторизация</p>

               <div class="hern">
        
                    <p class="fname">Логин</з>
                    <input type="text" name="login" class="flname" placeholder="Введите Логин" Required>

                    <p class="fname">Пароль</з>
                    <input type="password" name="password" class="flname" placeholder="Введите пароль" required>

                </div>
                
                <button type="submit" class="next_button">Войти</button>

                <a class="head_link" href="mail.php">Забыли пароль?</a>
            </form>
        </article>
    </main>
</body>