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
    <link rel="stylesheet" href="orders.css">
</head>
<body>

<?php

$username = $_SESSION['username'];
$qry = "SELECT * FROM users WHERE username='$username' ";
$res = mysqli_query($conn, $qry);

$row = mysqli_fetch_assoc($res);
$name = $row['name'];
$surname = $row['surname'];
$email = $row['email'];
$password = $row['password'];
$role = $row['role'];
$profilepic = $row['profilepic'];

?>
<div class="container-fluid navigation">

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

<h5>Dozvoljeno je posedovati maksimalno 10 proizvoda u korpi.</h5>

<?php 
$product_qry = "SELECT * FROM products WHERE customer = '$username' ";
$product_res = mysqli_query($conn, $product_qry);
$res_number = mysqli_num_rows($product_res);

if($res_number == 0){
    echo "<p>Još uvek nemate kupljenih proizvoda!</p>";
}else{
    echo "<p>Trenutno u korpi imate: " . $res_number . " proizvoda</p>";
    while($row = mysqli_fetch_array($product_res)){
        $name = $row['name'];

        $product_pic = "SELECT picture FROM products_gallery WHERE product = '$name' ";
        $prod_res = mysqli_query($conn, $product_pic);
        $prod_i = mysqli_fetch_array($prod_res);
        $prod_final = $prod_i['picture'];
?>
<div class="my-products">
    <div class="container product">
        <?php echo "<a href='product-page.php?name=".$row['name']."' style='text-decoration-color:white'>"; ?>
        <img src="products-pics/<?php echo $prod_final; ?>" width="" height="100%" class="product-pic">
        <p class="left"><?php echo $row['name']; ?><span class="price">Cena: <?php echo $row['price'].$row['currency']; ?></span></p>
        <p class="right"><?php echo $row['location']; ?><span class="type2"><?php echo $row['type']; ?></span></p>
        <?php echo "</a>"; ?>
    </div>
    <?php echo "<a href='remove-order.php?name=".$row['name']."' onclick='return checkdelete()'>"; ?>
        <button class="delete-button">Otkaži</button>
    <?php echo "</a>";
    }
}
?>   
</div>


<script>
    function checkdelete(){
        return confirm('Da li ste sigurni da želite da otkažete porudžbinu?');
    }
</script>
</body>
</html>