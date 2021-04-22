<?php

include 'config.php';
session_start();

$name = $_GET['name'];
$sql = "UPDATE products SET sold = 'yes' WHERE name = '$name'";
$result = mysqli_query($conn, $sql);


if($result > 0){
    header("Location: salesman-send.php?success=Submitted");
    exit(); 
}
else{
    header("Location: salesman-send.php?error=Error");
    exit(); 
}