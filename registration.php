<?php
session_start();
include 'db-conn.php';
if($_SERVER["REQUEST_METHOD"]=='POST') 
{
    $email=$_POST['email'];
    $password=password_hash( $_POST['pass'],PASSWORD_DEFAULT);
    $username=$_POST['username'];
    $stm="INSERT into users (name, email, password) values ('$username','$email','$password') ";
    $conn=OpenCon();
    if($conn->query($stm) == true ){
    echo"Your account has been created !";
    $_SESSION['user']=["name"=>$username, "email"=>$email ];
    header('location:login.php');
    }
    else
    echo "Failed creating your account. ".$conn->error;

    CloseCon($conn);

}

 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <br>
    <form action="#" method="POST">
        <input type="text" name="username" placeholder="Name" required> 
        <br>
        <input type="email" name="email" placeholder="email" required>
        <br>
        <input type="password" name="pass" placeholder="password" required>
        <input type="submit" value="Sign Up">
        <br> Do you already have an account? <br>
        <a href="login.php">Sign In</a>

    </form>
    
</body>
</html>