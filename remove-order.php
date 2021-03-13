<?php

include 'config.php';
session_start();

$product_name = $_GET['name'];
$customer = '';
$delievery = '';

$remove_qry = "UPDATE products SET `customer` = '$customer', `delievery` = '$delievery' WHERE name='$product_name' ";
$res = mysqli_query($conn, $remove_qry);

if($res){
    header("location:orders.php");
}else{
    echo "ERROR WHILTE TRYING TO REMOVE ORDER!";
}
?>