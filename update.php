<?php
    $UserID=$_COOKIE['idUser'];
    require_once "conectdb.php";
    $queryUserCheck = mysqli_query($conn, "SELECT * FROM `users` WHERE `id.user`=$UserID"); 
    $user = mysqli_fetch_array($queryUserCheck);

    $imgUser = $user["images"];
    $img_User = $_POST["img"];
    $FIO = $_POST["FIO"];
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    if(empty($img_User)){
        $img_User=$user[5];
    }
    $sql="UPDATE `users` SET `FIO`='$FIO',`login`='$login',`email`='$email',`password`='$password',`images`='$img_User' WHERE `id.user`=$UserID";
    if($conn->query($sql)){
        header('Location:account.php');
    } else{
        echo "Ошибка: " . $conn->error;
    }
?>