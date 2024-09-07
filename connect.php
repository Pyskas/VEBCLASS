<?php
if (isset($_POST["full_name"]) && isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["password"])) {
      
    require_once "conectdb.php";

    $full_name = $conn->real_escape_string($_POST["full_name"]);
    $login = $conn->real_escape_string($_POST["login"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $img = $conn->real_escape_string($_POST["image"]);
    $role_id = 1;
    $status_id = 1;
    if(!empty($full_name) ) {
        $sql = "INSERT INTO `users` (FIO, login, email, password, images, role_id, status_id) VALUES ('$full_name', '$login', '$email', '$password', '$img', $role_id, $status_id)";
        if($conn->query($sql))
        {
            header('Location:autorization.php');
        } else
        {
            echo "Ошибка: " . $conn->error;
        }
    }
    else {
        echo "<script>
            alert('hello erorr');
            location.href='reg.php';
        </script>  ";
              
    }
}
?>