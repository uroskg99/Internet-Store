<?php


$db_servername = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "internet_store";
$conn = mysqli_connect($db_servername, $db_user, $db_pass, $db_name);



$mysqli = new mysqli("localhost", "root", "", "internet_store");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if (mysqli_connect_errno()){
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}

?>