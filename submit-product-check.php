<?php

include 'config.php';
session_start();

$name = $_GET['name'];
$sql = "UPDATE products SET sold = 'yes' WHERE name = '$name'";
$result = mysqli_query($conn, $sql);


if($result > 0){
    header("Location: view-product.php?success=Submitted");
    exit(); 
}
else{
    header("Location: view-product.php?error=Error");
    exit(); 
}