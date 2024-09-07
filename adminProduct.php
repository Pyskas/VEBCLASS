<?php
require 'conectdb.php';
$listproductquery = mysqli_query($conn, "SELECT * FROM products");
$listproduct = mysqli_fetch_all($listproductquery);

$categoryquery = mysqli_query($conn, "SELECT * FROM categories");
$category = mysqli_fetch_all($categoryquery);

$statusquery = mysqli_query($conn, "SELECT * FROM statusproducts");
$status = mysqli_fetch_all($statusquery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleAdmin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                    echo "<a class='head_link' href='logout.php'>Выйти</a>";
                    }
                    ?>
                </div>
                <a class="head_link" href="adminPanel.php">Пользователи</a>
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

<body>
    <h1>Все курсы</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Добавить товар
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">Добавление товара</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="" action="addproduct.php" method="POST">
                    <div class="modal-body">
                        <p>Имя курса: 
                            <input type="text" name="nameproduct"></p>
                        <p>Изображение: 
                            <input type="file" name="nameimg"></p>
                        <p>Описание: 
                            <textarea type="text" name="description"></textarea>
                        <p>Цена: 
                            <input type="number" name="cost"></p>
                        <p>Размер скидки:
                            <input type="number" name="discount"></p>
                        <p>Категория курсов:
                            <select name="category_id">
                                <option>Выберите категорию</option>
                                <?php foreach ($category as $category_item):?>
                                    <option value="<?=$category_item[0];?>"><?=$category_item[1];?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                        <p>Статус курса: 
                            <select name="status_id">
                                <option>Выберите статус</option>
                                <?php foreach ($status as $status_item):?>
                                    <option value="<?=$status_item[0];?>"><?=$status_item[1];?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php foreach ($listproduct as $item):?>
        <form class="renamedelpr" action="adminProduct-db.php" method="post" enctype="multipart/form-data">
            <p>ID: <input name="idproduct" value="<?=$item[0]; ?>"></p> 
            <p>Имя курса: <input type="text" name="nameproduct" value="<?=$item[1]; ?>"></p>
            <p>Name img: <input type="text" name="oldimg" value="<?=$item[2]; ?>"></p>
            <p>Name img: <input type="file" name="nameimg" value="<?=$item[2]; ?>"></p>
            <p>Описание: <input type="text" name="description" value="<?=$item[3]; ?>"></p>
            <p>Цена <input type="number" name="cost" value="<?=$item[4]; ?>"></p>
            <p>Скидка <input type="number" name="discount" value="<?=$item[5]; ?>"></p>
            <p>Category_id <select name="category_id">
                <?php foreach ($category as $category_item): ?>
                    <option value="<?= $category_item[0]; ?>" <?php if($category_item[0] == $item[6]) echo 'selected'; ?>><?= $category_item[1]; ?></option>
                <?php endforeach; ?>
            </select></p>
            <p>Статус курса: <input type="number" name="status" value="<?= $item[7]; ?>"></p>
            <div class="btns_productline">
            <button type="submit" name="update" value="update">Изменить</button> 
                <?php
                if($item[7]==2){
                    echo "<button type='submit' name='require' id='require' value='require'>Восстановить</button> ";
                }else{
                    echo "<button type='submit' name='delete' id='delete' value='delete'>Удалить</button> ";
                }
                ?>
            </button> 
               
            </div>
            
            
        </form>
    <?php endforeach; ?>
            <script>
                    const btn = document.getElementById("delete");
                    btn.addEventListener("click", ()=>{
                        const result = confirm("Точно удалить?");
                        if(result===true)
                            console.log("Данные удалены");
                        else
                            console.log("Программа продолжает работать");
                    });
            </script>   
</body>
</html>