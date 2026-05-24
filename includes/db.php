<?php
$host ="localhost";
$user ="root";
$password ="";
$database = "user_management_system";
$conn = mysqli_connect($host,$user,$password,$database);
if(!$conn){
    die("Database Connection Failed");
}
?>

