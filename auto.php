<?php
require "conectdb.php";
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$queryUser = mysqli_query($conn, "SELECT * FROM users INNER JOIN statuses on users.status_id=statuses.status_id INNER JOIN roles on users.role_id=roles.role_id WHERE login='$login' AND password='$password'"); 
$user = mysqli_fetch_array($queryUser);
$idUser = $user["id.user"];
$role = $user['role_id'];
if(!empty($idUser)) {
    if ($user["status_name"] == 'Заблокирован') {
        echo "<script>alert('Пользователь заблокирован. Обратитесь к администратору.');
        location.href='autorization.php';</script>";
    } else {
        setcookie('idUser', $idUser, time() + 3600, "/");

        setcookie('roles', $role, time() + 3600, "/");

        
        if($user["role_name"] == 'Админ'){
            header('Location: adminPanel.php');
        } else {
            header('Location: account.php');
        }        
    }
} else {
    echo "<script>alert('Данный пользователь не найден!');
    location.href='autorization.php';
    </script>";
}

?>