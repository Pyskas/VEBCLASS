<?php
// require "conectdb.php";
// $userID = $_POST["idUser"];
// $unblocked = $_POST["unblocked"];
// $blocked = $_POST["blocked"];
// if (empty($unblocked)) {
//     $query = mysqli_query($conn, "UPDATE users SET status_id='2' WHERE users.id.user=$userID");
//     echo "<script>
//     alert('Пользователь заблокирован');
//     location.href='adminPanel.php'; 
//     </script>";
// } else {
//     $query = mysqli_query($conn, "UPDATE users SET status_id='1' WHERE users.id.user=$userID");
//     echo "<script>
//     alert('Пользователь разблокирован');
//     location.href='adminPanel.php'; 
//     </script>";
// }
require 'conectdb.php';

if (isset($_POST['blocked'])) {
    $userId = $_POST['blocked'];
    $updateQuerry = "UPDATE users SET status_id = 2 WHERE `id.user` = $userId";
    mysqli_query($conn, $updateQuerry);
    echo"<script>
    alert('Пользователь заблокирован');
    location.href='adminPanel.php'; 
  </script>";
} elseif (isset($_POST['unblocked'])) {
    $userId = $_POST['unblocked'];
    $updateQuerry = "UPDATE users SET status_id = 1 WHERE `id.user` = $userId";
    mysqli_query($conn, $updateQuerry);
    echo"<script>
         alert('Пользователь разблокирован');
         location.href='adminPanel.php'; 
       </script>";
}
?>