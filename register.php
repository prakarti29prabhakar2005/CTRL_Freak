<?php

@include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rollno = mysqli_real_escape_string($conn, $_POST['rollno']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = 'pass'") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'user already exists!';
    }
    else{
        if($pass != $cpass){
            $message[] = 'confirm password not matched!';
        }
        else{
            mysqli_query($conn, "INSERT INTO `users`(name, rollno, email, password, user_type) VALUES('$name', '$rollno', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--font awesome link: to add new font style-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!--css file link-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    
    <?php
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove()"></i>
            </div>
            ';
        }
    }
    ?>

    <div class="form-container">
        <!--method attribute specifies how to send form-data, HTTP post transaction with method="post"-->
        <form action="" method="post">
            <h3>Register Now</h3>
            <!--name attribute is used to reference elements in a Javascript or to reference form data after a form is submitted-->
            <input type="text" name="name" placeholder="Enter your name" required class="box">
            <input type="text" name="rollno" placeholder="Enter your registered number" required class="box">
            <input type="email" name="email" placeholder="Enter your institute e-mail" required class="box">
            <input type="password" name="password" placeholder="Enter your password" required class="box">
            <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
            <select name="user_type" id=""  class="box">
                <option value="user">User</option>
                <option value="Admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register Now" class="btn">
            <!--php allows to create dynamic content and interact with database-->
            <p>Already have an account?<a href="login.php">Login now</a></p>
            
        </form>
    </div>
    
</body>
</html>