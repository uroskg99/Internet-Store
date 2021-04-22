<?php
include 'config.php';
session_start();


if(isset($_POST['add_product'])) {
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $product_name = validate($_POST['product_name']);
    $location = validate($_POST['location']);
    $type = validate($_POST['type']);
    $location = validate($_POST['location']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $currency = validate($_POST['currency']);
    $quantity = validate($_POST['quantity']);
}

if($currency == 'euro'){
    $price = $price * 120;
    $currency = 'din';
}

$username = $_SESSION['username'];
$qry = "INSERT INTO products(name, location, type, description, price, currency, quantity, salesman) VALUES('$product_name', '$location', '$type', '$description', '$price', '$currency','$quantity', '$username')";
$res = mysqli_query($conn, $qry);

$fileCount = count($_FILES['file']['name']);
    for($i=0;$i<$fileCount;$i++){
        $fileName = $_FILES['file']['name'][$i];
        $sql = "INSERT INTO products_gallery(product, picture) VALUES ('$product_name', '$fileName')";
        if($conn->query($sql)===TRUE){
            echo 'radi';
        }
        else{
            echo 'ne radi';
        }
        move_uploaded_file($_FILES['file']['tmp_name'][$i], 'products-pics/'.$fileName);
    }

if($res){
    header("Location: home-salesman1.php?success=Added successful");
    exit(); 
}else{
    header("Location: upload-product.php?error=Error");
    exit(); 
}
?>

