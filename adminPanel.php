<?php
require 'conectdb.php';
$listUserQuerry = mysqli_query($conn,"SELECT * FROM users INNER JOIN roles on users.role_id = roles.role_id INNER JOIN statuses on statuses.status_id = users.status_id WHERE roles.role_name = 'Пользователь'");
$listUser = mysqli_fetch_all($listUserQuerry);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Panel</title>
</head>
<header class="container">
        <article class="sec_one">
            <section class="logo_left">
                <p class="r70038">VEBCLASS ADMIN</p>
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
                <a class="head_link" href="adminProduct.php">Продукты</a>
                <a class="head_link" href="logout.php">Выйти</a>
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

                   <h1>Все пользователи</h1>
    <?php foreach ($listUser as $item):?>
    <form action="adminPanel-db.php" method="post">
        

        <p>ID: <input name="idUser" value="<?=$item[0]; ?>" readonly></p> 
        <p>FIO: <?=$item[1]?></p>
        <p>Login: <?=$item[2]?></p>
        <p>Email: <?=$item[3]?></p>
        <p>Status(id) <?=$item[11]?></p>
        <?php if($item[11] === 'Нормальный'):?>
            <button name="blocked" value="<?=$item[0]?>"> Заблокировать</button> 

        <?php else: ?>
            <button name="unblocked" value="<?=$item[0]?>"> Разблокировать</button> 

        <?php endif; ?>
    </form>
    <?php endforeach; ?>
    

            </form>
        </article>
    </main>
</body>
</body>
</html>