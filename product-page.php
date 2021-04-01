<?php

include 'config.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Internet Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="product-page.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>
<body>

<?php        
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
        <a href="home-customer.php">
            <img src="website-pics/logo.png" class="logo">
        </a>
    <div class="right-div">
    <h5>Ulogovani ste kao <?php echo $_SESSION['username']; ?></h5>
    <a class="nav-link dropdown-toggle right-a" href="#" id="navbardrop" data-toggle="dropdown">
        <img src="profile-pics/<?php echo $profilepic; ?>" width="45px" height="45px" class="mini-profile">
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="profile.php">Pogledaj Profil</a>
        <a class="dropdown-item" href="edit-profile.php">Izmeni Profil</a>
        <a class="dropdown-item" href="orders.php">Moje Porudžbine</a>
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

$product_name = mysqli_real_escape_string($conn, $_GET['name']);
$sql_gallery = "SELECT picture FROM products_gallery WHERE product='$product_name' ";
$result_gallery = mysqli_query($conn, $sql_gallery);

?>

<div class="container gallery">
    <div class="row justify-content-center mb-2">
        <div class="col-lg-10">
        <div id="demo" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($result_gallery as $row){
                $actives = '';
                if($i == 0){
                    $actives = 'active';
                }
            ?>
                <div class="carousel-item <?php echo $actives; ?>">
                    <img src="products-pics/<?php echo $row['picture']; ?>" alt="<?php echo $i; ?>" class="gallery-pic">
                </div>
                <?php $i++; } ?>
            </div>

            <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>

            </div>
        </div>
    </div>

</div>


<?php 

    $product_name = mysqli_real_escape_string($conn, $_GET['name']);
    $sql = "SELECT * FROM products WHERE name='$product_name' ";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $location = $row['location'];
    $type = $row['type'];
    $description = $row['description'];
    $price = $row['price'];
    $currency = $row['currency'];
    $quantity = $row['quantity'];
    $delievery = $row['delievery'];
    $salesman = $row['salesman'];
    $customer = $row['customer'];
    ?>
    <div class="container-fluid">
        <div class="info">
            <h5 class="small-info"><?php echo $name . ', '; ?><span>cena: <?php echo $price . $currency . '. Količina: ' . $quantity; ?></span></h5>
            <p>Kategorija proizvoda: <span class="type"><?php echo $type; ?></span></p>
            <br>
            <p><?php echo $description . '. Lokacija je: ' . $location; ?></p>
            <p>Vlasnik ovog proizvoda je:
                <?php echo "<a href='salesman-profile.php?salesman-name=". $salesman ."' style='text-decoration-color:white'>"; ?>
                    <span class="salesman">
                        <?php echo $salesman; ?>
                    </span>
                </a>
            </p>
        </div>
    </div>
    <?php


if(isset($_POST['order-online'])){
    $online = 'Online';
    $customer_name = $_SESSION['username'];

    $product_sql = "UPDATE products SET `customer` = '$customer_name', `delievery` = '$online' WHERE name='$name' ";
    $result_order = mysqli_query($conn, $product_sql);

    if($result_order){
        header("location:orders.php");
    }
}

if(isset($_POST['basic-order'])){
    $pouzecu = 'Po uzeću';
    $customer_name = $_SESSION['username'];

    $product_sql = "UPDATE products SET customer = '$customer_name', `delievery` = '$pouzecu' WHERE name='$name' ";
    $result_order = mysqli_query($conn, $product_sql);

    if($result_order){
        header("location:orders.php");
    }
}
?>
<?php

if(!isset($_SESSION['username'])){
    echo '<p class="p-info">Ne mozete kupiti proizvod jer niste prijavljeni!</p>';
}else{
if(strlen($customer) == 0){
    ?>

    <div class="container">
        <div class="row">
        
            <div class="col-md-5 online-payment">
            <form action="" method="POST">
                <h3>Plati online</h3>
                <div class="card-item">
                    <label class="label">Vlasnik kartice:</label>
                    <input type="text" class="input" placeholder="Vlasnik kartice" required> 
                </div>
                <div class="card-item">
                    <label class="label">Broj kartice:</label>
                    <input type="text" class="input" placeholder="Broj kartice" required> 
                </div>
                <div class="card-item">
                    <label class="label">Datum isteka:</label>
                    <input type="text" class="input" placeholder="00 / 00" required> 
                </div>
                <div class="card-item">
                    <label class="label">CVC:</label>
                    <input type="text" class="input" placeholder="0000" required> 
                </div>   
                <div class="card-item">
                    <label class="label">Adresa isporuke:</label>
                    <input type="text" class="input" placeholder="Kneza Miloša, 1" required> 
                </div>         

                <button type="submit" class="btn" name="order-online" onclick='return checkOrder()'>Online plaćanje</button>
            </form>
            </div>
        
           
            <div class="col-md-5 basic-payment">
            <form action="" method="POST"> 
                <h3>Po uzeću</h3>
                <div class="card-item">
                    <label class="label">Ime i prezime:</label>
                    <input type="text" class="input" placeholder="Ime i prezime" required> 
                </div>
                <div class="card-item">
                    <label class="label">Broj telefona:</label>
                    <input type="tel" class="input" placeholder="+381653001223" required> 
                </div>
                <div class="card-item">
                    <label class="label">Adresa isporuke:</label>
                    <input type="text" class="input" placeholder="Kneza Miloša, 1" required> 
                </div>

                <button type="submit" class="btn" name="basic-order" onclick='return checkOrder()'>Po uzeću</button>
            </form>
            </div>  
        </div>
    </div>



    <?php
    echo '</form>';
}else{
    echo '<p class="p-info">Već ste kupili ovaj proizvod</p>';
}
}

?>

<script>
    function checkOrder(){
        return confirm('Da li ste sigurni da želite da kupite ovaj proizvod?');
    }
</script>
</body>
</html>