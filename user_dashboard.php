<?php
include 'db-conn.php';
session_start();
if(!isset($_SESSION))
header('location:login.php');
else{
    ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dashboard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
<?php echo "Hi  ".$_SESSION['user']['name']; ?>
<br>
</br>
<form action="user_dashboard.php" id="Changing_Name" method="POST">
        <input type="text" name="newname" placeholder="New Name" required> 
        <br></br>
        <input type="password" name="pass" placeholder="Your Password" required> 
        <input type="submit" value="Change Name">
    </form>        
    <br></br>
    <a href="logout.php" >Log out</a>
    <br></br>
</body>
</html>
<?php  } ?>


<?php
if($_SERVER["REQUEST_METHOD"]=='POST') 
{
    $email=$_SESSION['user']['email'];
    $password=$_POST['pass'];          // Csrf metigation

    $stm="SELECT * FROM users WHERE email='$email'";    
    $conn=OpenCon();
    $query=$conn->query($stm);
    $data=$query->fetch_row();    //data[0]=name , data[1]=email, data[2]=pass , data[3]=role
    if($data!=null && password_verify($password,$data[2])){
    $newname=htmlspecialchars($_POST['newname']);       //////////////// xss metigation !! ///////////////////
    $stm="Update users set name='$newname' Where email='$email' ";
    $conn=OpenCon();
    $query=$conn->query($stm);
    if($query)
    {
    echo("Your Name has been updated succuessfully "); 
     $_SESSION['user']['name']=$newname;
    }
     }
    else
    echo("Your Password is not correct please, try again. ");

    CloseCon($conn);

 }
?>

