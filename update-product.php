<?php
include 'config.php';
session_start();

if(!isset($_SESSION['role'])){
    header("location:sign.php");
}

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'customer'){
        header("location:home-customer.php");
    }else if($_SESSION['role'] == 'admin'){
        header("location:home-admin1.php");
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Internet Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="home-salesman1.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>

<body>  
<?php      


$product_name = $_GET['name'];
$sql = "SELECT * FROM products WHERE name='$product_name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$location = $row['location'];
$price = $row['price'];
$type = $row['type'];
$currency = $row['currency'];
$quantity = $row['quantity'];

if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
$qry = "SELECT * FROM users WHERE username='$username' ";
$res = mysqli_query($conn, $qry);

while($row = mysqli_fetch_assoc($res)){
    $name = $row['name'];
    $surname = $row['surname'];
    $profilepic = $row['profilepic'];
}
?>
<div class="row row-column">
    <div class="col-md-12 column">
        <a href="salesman-products.php">
            <img src="website-pics/logo.png" class="logo">
        </a>
        
    <div class="right-div">
    
    <h5>Ulogovani ste kao <?php echo $_SESSION['username']; ?></h5>
    <a class="nav-link dropdown-toggle right-a" href="#" id="navbardrop" data-toggle="dropdown">
        <img src="profile-pics/<?php echo $profilepic; ?>" width="45px" height="45px" class="mini-profile">
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="home-salesman1.php">Početna stranica</a>
        <a class="dropdown-item" href="salesman-profile1.php">Pogledaj Profil</a>
        <a class="dropdown-item" href="edit-profile-salesman.php">Izmeni Profil</a>
        <a class="dropdown-item" href="salesman-products.php">Moji proizvodi</a>
        <a class="dropdown-item" href="salesman-send.php">Čeka se za slanje</a>
        <a class="dropdown-item" href="logout.php">Odjavi se</a>
    </div>
</div>
              
<?php 
}else{?>

<div class="row row-column">
    <div class="col-md-12 column">
        <a href="home-customer.php">
            <img src="website-pics/logo.png" class="logo">
        </a>
        <div class="right-div">
            <h5><a href="sign.php">Prijavite se ovde</a></h5>
        </div>
    </div>
</div>
<?php
}
?>

<div class="container formSignUp"><br>
<h3>Ažuriranje podataka</h3><br>
  <form action="" method="post" class="b" enctype="multipart/form-data">
        <div class="form-group">
            <label>Fotografije</label><br>
            <input type='file' name='file[]' id='file' multiple> 
            <button class="btn btn-dark" type="submit" name="button_update_images">Ažuriraj</button><br><br>
        </div>

        <div class="form-group">
        <label>Lokacija</label>
        <input type="text" class="form-control" name="update_location" value=<?php echo $location;?>><br>
        <button class="btn btn-dark" type="submit" name="button_update_location">Ažuriraj</button><br><br>
        </div>

        <div class="form-group">
        <label for="type">Kategorija</label>
        <select name="update_type" class="form-control">
           <option disabled selected><?php echo $type;?> </option>
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
        </select><br>
        <button class="btn" type="submit" name="button_update_type">Ažuriraj</button><br><br>
       </div>

       <div class="form-group">
            <label for="update_description">Tekst oglasa</label>
            <textarea type="text" class="form-control" name="update_description" cols="55" rows="5"></textarea><br>
            <button class="btn" type="submit" name="button_update_description">Ažuriraj</button><br><br>
        </div>

        <label for="price">Cena</label>
        <div class="form-group row">
         <div class="col-sm-6">
           <input type="text" class="form-control" value=<?php echo $price;?> name="update_price">
          </div>
          <div class="col-sm-3">
           <select name="update_currency" class="form-control">
              <option disabled selected><?php echo $currency;?></option>
              <option>euro</option>
              <option>din</option>
            </select>
           </div>
           <button class="btn" type="submit" name="button_update_price">Ažuriraj</button><br><br>
        </div>

        <div class="form-group">
            <label for="quantity">Količina</label>
            <input type="text" class="form-control" value=<?php echo $quantity;?> name="update_quantity"><br>
            <button class="btn" type="submit" name="button_update_quantity">Ažuriraj</button><br><br><br>
        </div>
    </form>
</div>

</body>
</html>

<?php

if(isset($_POST['button_update_location'])){
    $location = $_POST['update_location'];
    $sql = "UPDATE products SET location = '$location' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);
}

if(isset($_POST['button_update_type'])){
    $type = $_POST['update_type'];
    $sql = "UPDATE products SET type = '$type' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);
}

if(isset($_POST['button_update_description'])){
    $description = $_POST['update_description'];
    $sql = "UPDATE products SET description = '$description' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);
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

}

if(isset($_POST['button_update_quantity'])){
    $quantity = $_POST['update_quantity'];
    $sql = "UPDATE products SET quantity = '$quantity' WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);

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