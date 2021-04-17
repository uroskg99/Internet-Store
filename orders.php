<?php

include 'config.php';
session_start();

if(!isset($_SESSION['role'])){
    header("location:sign.php");
}

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == "admin"){
        header("location:home-admin.php");
    }else if($_SESSION['role'] == 'salesperson'){
        header("location:home-salesman.php");
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
    <link rel="stylesheet" href="orders.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/0cf2c937f3.js"></script>
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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

<div class="row row-column nav">
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
    </div>
</div>


<?php 
$product_qry = "SELECT * FROM products WHERE customer = '$username' ";
$product_res = mysqli_query($conn, $product_qry);
$res_number = mysqli_num_rows($product_res);?>

<div class="my-products">

<?php

if($res_number == 0){
    echo "<h3>Još uvek nemate kupljenih proizvoda!</h3>";
}else{
    echo "<h3>Trenutno u korpi imate: " . $res_number . " proizvoda</h3>";
    while($row = mysqli_fetch_array($product_res)){
        $id = $row['id'];
        $name = $row['name'];
        $product_pic = "SELECT picture FROM products_gallery WHERE product = '$name' ";
        $prod_res = mysqli_query($conn, $product_pic);
        $prod_i = mysqli_fetch_array($prod_res);
        $prod_final = $prod_i['picture'];
        $prod_sold = $row['sold'];
        $prod_delievered = $row['delievered'];
        if($prod_delievered != "yes"){
?>
    <div class="container product">
        <?php echo "<a href='product-page.php?name=".$row['name']."' style='text-decoration-color:white'>"; ?>
            <img src="products-pics/<?php echo $prod_final; ?>" width="" height="100%" class="product-pic">
            <div class="left"><?php echo $row['name']; ?></div>
            <div class="price">Cena: <?php echo $row['price'].$row['currency']; ?></div>
            <p class="right"><?php echo $row['location']; ?><span class="type2"><?php echo $row['type']; ?></span></p>
            <div><p class="desc"><?php echo $row['description']; ?><p></div>
        <?php echo "</a>"; ?>
    </div>
    <?php 
        if($prod_sold == 'yes'){
            ?>
            <div class="row justify-content-center text-message">
                <p class="arrived">Ova porudžbina je poslata, pritisnite ovo dugme da potvrdite da vam je dostava pristigla</p>
            </div>
            <div class="arrived-div row justify-content-center">
                <?php echo "<a href='rate-salesman.php?id=".$row['id']."' style='text-decoration-color:white'>"; ?>
                    <button id="button-arrived" class="button-arrived">Primio sam porudžbinu</button>
                <?php echo '</a>'; ?>
            </div>

            <?php
        }else{
    ?>
        <div class="row justify-content-center delete-order">
            <?php echo "<a href='remove-order.php?name=".$row['name']."' onclick='return checkdelete()'>"; ?>
                <button id="delete-button" class="delete-button">Otkaži</button>
            <?php echo "</a>";
        }?>
        </div>

        

        <?php
        }
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