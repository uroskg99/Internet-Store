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
    <link rel="stylesheet" href="home-customerc.css">
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
</div>
<div class="row">
    <div class="col-md-2 left-side">
        <ul class="list-group list-group-flush">
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Antikviteti</p>
            </li>
            </a> 
            <a href="#">       
            <li class="list-group-item list-group-item-action">
                <p class="type">Audio</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Automobili</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Bela tehnika</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Bicikli</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Domaća hrana</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Dvorište i bašta</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Elektronika</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Igračke i igre</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Knjige</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Kompjuteri</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Konzole i igrice</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Kućni ljubimci</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Mobilni telefoni</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Motocikli</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Muzika i instrumenti</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Nakit, satovi</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Nameštaj</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Nekretnine</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Odeća</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">Sport</p>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <p class="type">TV i video</p>
            </li>
            </a>
        </ul>
    </div>

    <?php 
    
        $product_qry = "SELECT * FROM products";
        $product_res = mysqli_query($conn, $product_qry);
        $res = mysqli_num_rows($product_res);
    ?>

    <div class="col-md-8">
    <?php 
    
    if($res == 0){
        echo "Nema rezultata";
    }else{
        while($product_data = mysqli_fetch_assoc($product_res)){
            if(strlen($product_data['customer']) == 0){
                
                $product_name = $product_data['name'];

                $product_pic = "SELECT picture FROM products_gallery WHERE product = '$product_name' ";
                $prod_res = mysqli_query($conn, $product_pic);
                $prod_i = mysqli_fetch_array($prod_res);
                $prod_final = $prod_i['picture'];
        ?>
        <?php echo "<a href='product-page.php?name=".$product_data['name']."' style='text-decoration-color:white'>"; ?>
            <div class="container product">
                <img src="products-pics/<?php echo $prod_final; ?>" width="" height="100%" class="product-pic">
                <p class="left"><?php echo $product_data['name']; ?><span class="price">Cena: <?php echo $product_data['price']; ?></span></p>
                <p class="right"><?php echo $product_data['location']; ?><span class="type2"><?php echo $product_data['type']; ?></span></p>
            </div>
        <?php echo "</a>"; 
            }
        }
    }
    ?>
    </div>
</div>

</body>
</html>