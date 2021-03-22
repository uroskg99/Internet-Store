<?php

include 'config.php';
session_start();

$name = $_GET['name'];
$sql = "DELETE FROM users WHERE name='$name'";
$result = mysqli_query($conn, $sql);


if($result > 0){
    header("Location: home-admin.php?success=Deleted");
    exit(); 
}
else{
    header("Location: home-admin.php?error=Error");
    exit(); 
}