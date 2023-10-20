<?php
function OpenCon()
{ 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "auth-demo";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: ". $conn -> error);
return $conn;
}
function CloseCon($conn)
{
$conn -> close();
}
?>