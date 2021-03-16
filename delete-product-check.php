<?php

include 'config.php';
session_start();

$name = $_GET['name'];
$sql = "DELETE FROM products WHERE name='$name'";
$result = mysqli_query($conn, $sql);

$sql = "DELETE FROM products_gallery WHERE product='$name'";
$result = mysqli_query($conn, $sql);

if($result > 0){
    header("Location: home-salesman.php?success=Deleted");
    exit(); 
}
else{
    header("Location: home-salesman.php?error=Error");
    exit(); 
}