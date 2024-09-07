<?php 
require "conectdb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['email'];

    // Generate password
    function generatePassword($length) {
        $chars = array_merge(range('a', 'z'), range('A', 'Z'));
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[array_rand($chars)];
        }
        return $password;
    }
    $pass = generatePassword(8);

    // Send email
    $subject = "Ваш новый пароль";
    $message = "Ваш новый пароль: $pass";
    if (mail($to, $subject, $message)) {
        // Update password in database
        $sql = "UPDATE users SET password='$pass' WHERE email = '$to'";
        $stmt = mysqli_query($conn, $sql);
    } else {
        echo "<script>alert('Failed to send email')</script>";
    }
}
header("Location:autorization.php");
?>
?>