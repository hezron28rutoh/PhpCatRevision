<?php
//check if the button has been clicked
if (isset($_POST["btn_reg"])){
//    take data from the form
    $userName = $_POST["u_name"];
    $password = $_POST["u_pass"];
//    encrypt the password
    $encryptedPassword = md5($password);
//    connect to db
    require_once "db_connection.php";
    $insertQuery = "INSERT INTO `users`(`id`, `username`, `password`) 
            VALUES (null,'$userName','$encryptedPassword')";
    $selectExistingUserQuery = "SELECT * FROM `users` WHERE username='$userName'";
    $existingUsers = mysqli_query($connection,$selectExistingUserQuery);
    $countExistingUsers = mysqli_num_rows($existingUsers);
    if ($countExistingUsers > 0){
        echo "Sorry, user with that username already exists";
    }else{
        $save = mysqli_query($connection,$insertQuery);
        if (isset($save)){
            echo "user registered successfully";
        }else{
            echo "User registration failed";
        }
    }
}