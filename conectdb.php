<?php
$conn = new mysqli("localhost", "root", "", "vebclass");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    ?>