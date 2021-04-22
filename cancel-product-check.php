<?php

include 'config.php';
session_start();

$name = $_GET['name'];
$sql = "UPDATE products SET customer = '' WHERE name = '$name'";
$result = mysqli_query($conn, $sql);


if($result > 0){
    header("Location: salesman-send.php?success=Deleted");
    exit(); 
}
else{
    header("Location: salesman-send.php?error=Error");
    exit(); 
}