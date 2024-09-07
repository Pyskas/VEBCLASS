<?php
setcookie('idUser', $idUser, time() - 3600, "/");
setcookie('roles', $role_id, time() - 3600, "/");
header("Location: index.php");
exit();
?>