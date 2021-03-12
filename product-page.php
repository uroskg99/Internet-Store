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
</head>
<body>
<?php

$username = $_SESSION['username'];
$qry = "SELECT * FROM users WHERE username='$username' ";
$res = mysqli_query($conn, $qry);

while($row = mysqli_fetch_assoc($res)){
    $name = $row['name'];
    $surname = $row['surname'];
    $profilepic = $row['profilepic'];
}

?>
<div class="navigation">

    <nav class="navbar navbar-expand-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
                <h5>You are logged in as <?php echo $_SESSION['username']; ?>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <img src="profile-pics/<?php echo $profilepic; ?>" width="40px" height="40px">
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php">View Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="orders.php">My orders</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home-customer.php">Home Page</a>
            </li>
        </ul>
    </nav>
<br>
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

    <div class="container">
        <h5><?php echo $name . ' '; ?><span>Cena: <?php echo $price . $currency . '. Količina: ' . $quantity; ?></span></h5>
        <p>Kategorija proizvoda: <?php echo $type; ?></p>
        <br>
        <p><?php echo $description . ' Lokacija je: ' . $location; ?></p>
        <div class="row">
            <div class="col-sm-12">
                Vlasnik ovog proizvoda je: <?php echo $salesman; ?>
            </div>
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

?>

<script>
    function checkOrder(){
        return confirm('Da li ste sigurni da želite da kupite ovaj proizvod?');
    }
</script>
</body>
</html>