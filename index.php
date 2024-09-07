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
                        echo "<a class='head_link' href='adminPanel.php'>Администратор</a>";
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

    <main class="bg_two">
        <article class="container">
            <section class="sec_left">
                <p class="yel40036_four">VEB</p>
                <p class="rob80070">Курсы по разработке приложений</p>
                    <form action="reg.php">
                <button class="yel_btn_one">
                        <p class="rob20700_two_exp">Регистрация</p> <img src="/img/arrow_btn_right.svg" alt="btn">
                </button>
                </form>
                </section>
        </article>
        
    </main>

    <main class="container">
        <article class="sec_three swiper">
            <div  class="swiper-wrapper" >
                <section   class="text_in_img swiper-slide right_img"><img style="width: 100px" src="/img/a1 (1).svg" alt="logo">
                    <p class="yel40036">VEB</p>
                    <p class="rob40040">Это поддержка 24/7</p>
                </section>
                <section class="text_in_img swiper-slide right_img"><img style="width: 100px" src="/img/a1 (2).svg" alt="logo">
                    <p class="yel40036_two">VEB</p>
                    <p class="rob40040_two">Это качественное обучение</p>
                </section>
                <section  class="text_in_img swiper-slide right_img"><img style="width: 100px" src="/img/a1 (3).svg" alt="logo">
                    <p class="yel40036_two">VEB</p>
                    <p class="rob40040_two">Это плановые занятия с вами</p>
                </section>
                <section  class="text_in_img swiper-slide right_img"><img  style="width: 100px" src="/img/Shape.svg" alt="logo">
                    <p class="yel40036_two">VEB</p>
                    <p class="rob40040_two">Это открытые уроки с кураторами</p>
                </section>
            </div>
            <div class="swiper-pagination"></div>
        </article>
    </main>

    <main class="bg_three">

        <article class="container">
            <img class="about" src="/img/18.jpg" alt="about">
            <section class="all_right">
                <section class="right_text_three_sec">
                    <section class="textik">
                        <p class="yel40036_two">О курсах VEBCLASS</p>
                        <p class="rob80050">Мы специализируемся в обучении разных направлений веб-разработки</p>
                        <p class="os40018_five">Наши направления имеют широкий спектр образования,мы может сделать из вас как Junior разработчика,так и довести до Senior разработчика.</p>
                    </section>
                    <section class="two_boxex_text">
                        <section class="boxes">
                            <img src="/img/b (1).svg" alt="ipdown">
                            <div class="text_box">
                                <p class="rob80025">Лучшие показатели</p>
                                <p class="os40018_three">У нас лучшие показатели обучения среди сервисов по обучению.</p>
                            </div>
                        </section>
                        <section class="boxes">
                        <img src="/img/b (2).svg" alt="ipdown">
                            <div>
                                <p class="rob80025">Высокие стандарты</p>
                                <p class="os40018_three">Стандарты наших курсов очень высоки,мы даём ученикам только нужное.</p>
                            </div>
                        </section>
                    </section>
                    <button class="gray_btn">
                        <a class="gray_btn_a" href="autorization.php">
                            <p class="rob20700_two">Проверь сейчас</p> <img src="/img/arrow_btn_right.svg" alt="btn">
                        </a>
                    </button>
                </section>
            </section>
        </article>
    </main>

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
                                        <p class="os60015"><?= $product[4] ?>₽</p>
                                        <p class="os60018"><?= $product[4] - ($product[4] * $product[5]) / 100 ?>₽</p>
                                    </div>
                                    <img src="/img/Star.svg" alt="">
                                </section>
                            </div>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </section>
                </section>

            <button class="gray_btn">
                <a class="gray_btn_a" href="lookmore.php">
                    <p class="rob20700_two">Смотреть больше</p> <img src="/img/arrow_btn_right.svg" alt="btn">
                </a> </button>
        </article>
    </main>

    <main class="bg_four">
        <article class="three_boxes_f">
            <div class="one_box">
                <button class="wbtn">
                    <a class="rob50025" href="autorization.php">Вход</a>
                </button>
            </div>

            <div class="two_box">
                <button class="wbtn">
                    <a class="rob50025" href="#demo-2-bottom" id="demo-2-top">Курсы</a>
                </button>
            </div>

            <div class="three_box">
                <button class="wbtn">
                    <a class="rob50025" href="reg.php">Регистрация</a>
                </button>
            </div>
        </article>
    </main>

    <main class="container">
        <article class="bg_last">
            <p class="rob80050_two">Разрешить рассылку новостей
            </p>

            <section class="form_foot">
                <form action="post">
                    <input type="text" placeholder="Ваш Email адрес">
                </form>
                <button class="gray_btn">
                    <a class="gray_btn_a" href="#">
                        <p class="rob20700_two">Подписаться</p>
                    </a>
                </button>
            </section>
        </article>

    </main>

    <footer class="container">

        <article class="sec_last">

            <section class="sec_last_two">

                <section class="left_sec">
                    <p class="rob70030">Связь с нами</p>
                    <section class="box_foot">
                        <div class="text_foot">
                            <p class="os60018">Email</p>
                            <a href="#" class="os40018">ivan.podoprigorov@mail.ru</a>
                        </div>
                        <div class="text_foot">
                            <p class="os60018">Телефон</p>
                            <a href="#" class="os40018">7 937 850 33 51</a>
                        </div>
                        <div class="text_foot">
                            <p class="os60018">Адрес</p>
                            <a href="#" class="os40018">РФ г.Уфа ул.Первомайская 88</a>
                        </div>
                    </section>
                </section>

                <div class="line_height"></div>

                <section class="center_foot">
                    <section class="logo_text_f">
                    <div class="logo_foot">
                        <p class="rob70038">VEBCLASS</p>
                    </div>

                    <p class="os40018_two">Все права защищены,всякое копирование материала является кражей интеллектуальных ценностей</p>
                    </section>

                    <section class="icons_message">
                        <a href="instagram.com"><img src="/img/inst.svg" alt="inst"></a>
                        <a href="facebook.com"><img src="/img/facebook.svg" alt="fbook"></a>
                        <a href="twitter.com"><img src="/img/twitter.svg" alt="twiiter"></a>
                        <a href="pinterest.com"><img src="/img/pinterest.svg" alt="pin"></a>
                    </section>
                </section>
                <div class="line_height"></div>
                <section class="right_sec_foot">
                    <p class="rob70030">Дополнительно</p>

                        <div class="text_under_two">
                            <a href="mail.php" class="os40018">Забыл пароль</a>

                        </div>
                </section>
            </section>
        </article>
    </footer>

    <div class="line_vert"></div>

    <div class="go-top" style=" width: 100px; height: 100px; position: fixed; bottom: 50px; right: 50px; background-color: #274C5B; justify-content: center; align-items: center; border-radius: 20px;">▲</div>

    
<section class="copy">
    <p class="last_word">Copyright</p> 
    <p class="last_word">©</p>
    <p class="last_word_two">VEBCLASS</p> 
</section>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="./script.js"></script>
</body>

</html>