<?php
$UserID = $_COOKIE['idUser'];
$rolsql =  mysqli_query($conn,"SELECT role_id FROM users WHERE `id.user` = $UserID");
$rolmas = mysqli_fetch_array($rolsql);
$role_id = $rolmas["role_id"];
setcookie('roles', $role_id, time() + 3600, "/");
?>