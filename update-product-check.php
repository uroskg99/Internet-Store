<!DOCTYPE html>
<html>
<head>
    <title>Internet Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>  

<div class="add" id="add">
  <form action="" method="post" class="b" enctype="multipart/form-data">
        <p class="start">Uredi podatke: </p>
        
        <div class="form-group">
        <label>Naziv oglasa:</label>
        <input type=text name="update_product_name" placeholder="Unesi naziv oglasa:"><br>
        <button class="btn btn-dark" type="submit" name="button_update_product_name">Izmeni naziv</button><br><br><br>
        </div>

        <div class="form-group">
        <label>Lokacija:</label>
        <input type=text name="update_location" placeholder="Unesi lokaciju:"><br>
        <button class="btn btn-dark" type="submit" name="button_update_location">Izmeni lokaciju</button><br><br><br>
        </div>

        <div class="form-group">
        <label for="type">Kategorija</label>
        <select name="update_type" class="form-control">
           <option disabled selected>Unesi kategoriju: </option>
           <option>Antikviteti</option>
           <option>Audio</option>
           <option>Automobili</option>
           <option>Bela tehnika</option>
           <option>Bicikli</option>
           <option>Domaća hrana</option>
           <option>Dvorište i bašta</option>
           <option>Elektronika</option>
           <option>Igračke i knjige</option>
           <option>Knjige</option>
           <option>Kompjuteri</option>
           <option>Konzole i igrice</option>
           <option>Kućni ljubimci</option>
           <option>Mobilni telefoni</option>
           <option>Motocikli</option>
           <option>Muzika i instrumenti</option>
           <option>Nakit, satovi</option>
           <option>Nameštaj</option>
           <option>Nekretnine</option>
           <option>Odeća</option>
           <option>Sport</option>
           <option>TV i Video</option>
        </select>
        <button class="btn btn-dark" type="submit" name="button_update_type">Izmeni kategoriju</button><br><br><br>
       </div>

       <div class="form-group">
            <label for="update_description">Tekst oglasa</label>
            <textarea type="text" class="form-control" name="update_description" cols="55" rows="5" placeholder="Unesi tekst oglasa:"></textarea>
            <button class="btn btn-dark" type="submit" name="button_update_description">Izmeni tekst oglasa</button><br><br><br>
        </div>

        <label for="price">Cena</label>
        <div class="form-group row">
         <div class="col-sm-6">
           <input type="text" class="form-control" placeholder="Unesi cenu:" name="update_price">
          </div>
          <div class="col-sm-3">
           <select name="update_currency" class="form-control">
              <option disabled selected>Izaberi valutu: </option>
              <option>euro</option>
              <option>din</option>
            </select>
           </div>
           <button class="btn btn-dark" type="submit" name="button_update_price">Izmeni cenu i valutu</button><br><br><br>
        </div>

        <div class="form-group">
            <label for="quantity">Količina</label>
            <input type="text" class="form-control" placeholder="Unesi količinu:" name="update_quantity">
            <button class="btn btn-dark" type="submit" name="button_update_quantity">Izmeni količinu</button><br><br><br>
        </div>
        <div class="form-group">
            <input type='file' name='file[]' id='file' multiple> 
            <button class="btn btn-dark" type="submit" name="button_update_images">Izmeni fotografije</button><br><br><br>
        </div>
    </form>
</div>

</body>
</html>

<?php

include 'config.php';
session_start();

$product_name = $_GET['name'];
$sql = "SELECT * FROM products WHERE name='$product_name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['button_update_product_name'])){
    $name = $_POST['update_product_name'];
    $sql = "UPDATE products SET name = '$name' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: home-salesman.php?success=Name updated successfully");
        exit(); 
    }else{
        header("Location: home-salesman.php?error=Error");
        exit(); 
    }
}

if(isset($_POST['button_update_location'])){
    $location = $_POST['update_location'];
    $sql = "UPDATE products SET location = '$location' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: home-salesman.php?success=Location updated successfully");
        exit(); 
    }else{
        header("Location: home-salesman.php?error=Error");
        exit(); 
    }
}

if(isset($_POST['button_update_type'])){
    $type = $_POST['update_type'];
    $sql = "UPDATE products SET type = '$type' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: home-salesman.php?success=Type updated successfully");
        exit(); 
    }else{
        header("Location: home-salesman.php?error=Error");
        exit(); 
    }
}

if(isset($_POST['button_update_description'])){
    $description = $_POST['update_description'];
    $sql = "UPDATE products SET description = '$description' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: home-salesman.php?success=Description updated successfully");
        exit(); 
    }else{
        header("Location: home-salesman.php?error=Error");
        exit(); 
    }
}

if(isset($_POST['button_update_price'])){
    $price = $_POST['update_price'];
    $currency = $_POST['update_currency'];
    if($currency == 'euro'){
        $price = $price * 120;
        $currency = 'din';
    }

    $sql = "UPDATE products SET price = '$price' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    $sql = "UPDATE products SET currency = '$currency' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: home-salesman.php?success=Price and currency updated successfully");
        exit(); 
    }else{
        header("Location: home-salesman.php?error=Error");
        exit(); 
    }
}

if(isset($_POST['button_update_quantity'])){
    $quantity = $_POST['update_quantity'];
    $sql = "UPDATE products SET quantity = '$quantity' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: home-salesman.php?success=Quantity updated successfully");
        exit(); 
    }else{
        header("Location: home-salesman.php?error=Error");
        exit(); 
    }
}

if(isset($_POST['button_update_images'])){
    $sql = "DELETE FROM products_gallery WHERE product='$product_name'";
    $result = mysqli_query($conn, $sql);

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
}
?>