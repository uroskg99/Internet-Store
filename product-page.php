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
    <link rel="stylesheet" href="home-customer.css">
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
<div class="container-fluid navigation">
    <nav class="navbar navbar-expand-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="home-customer.php">Home Page</a>
            </li>
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
                    <a class="dropdown-item" href="#">My orders</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
<br>
<?php 

$name_search = mysqli_real_escape_string($conn, $_GET['name']);
$sql = "SELECT * FROM products WHERE name='$name_search'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){   

?>

<div class="container all-info">
    <div class="product_name">
        <h3><?php echo $row['name']; ?></h3>
    </div>

    <div class="row">
        <div class="col-sm-6">
           <div class="product_price"><?= "Cena: " . $row['price'] ." " . $row['currency']?></div>
           <div class="product_type"><?= "Tip: " . $row['type']?></div>
           <div class="product_quantity"><?= "Raspoloživo: " . $row['quantity']?></div>
           <div class="product_delivery"><?= "Način dostave: " . $row['delievery']?></div>
        </div>

        <div class="col-sm-6">
           <div class="product_salesman"><?= $row['salesman']?></div>
           <div class="product_location"><?= $row['location']?></div>
        </div>
   </div>
   <br>

   <div class="product_description"><?= $row['description'] ?></div>

   <div class="product_image_gallery">
   
   </div>

</div>

<?php
}
?>

</div>
</body>
</html>