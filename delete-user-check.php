<?php

include 'config.php';
session_start();

$username = $_GET['username'];
$sql = "DELETE FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);


if($result > 0){
    header("Location: home-admin.php?success=Deleted");
    exit(); 
}
else{
    header("Location: home-admin.php?error=Error");
    exit(); 
}