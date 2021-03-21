<?php

include 'config.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Internet Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="home-sale.css">
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

<div class="row row-column">
    <div class="col-md-12 column">
        <a href="home-customer.php">Početna stranica</a>
        <a href="upload-product.php">Postavi oglas</a>
        <a href="view-product.php">Pregledaj poružbine</a>
        <div class="right-div">

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
            <h5>Prijavljeni ste kao <?php echo $_SESSION['username']; ?>
            <a class="nav-link dropdown-toggle right-a" href="#" id="navbardrop" data-toggle="dropdown">
                <img src="profile-pics/<?php echo $profilepic; ?>" width="40px" height="40px">
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.php">Pogledaj profil</a>
                <a class="dropdown-item" href="edit-profile.php">Izmeni profil</a>
                <a class="dropdown-item" href="orders.php">Moje porudžbine</a>
                <a class="dropdown-item" href="logout.php">Odjavi se</a>
            </div>
        <?php 
        }else{?>
            <h5><a href="sign.php">Prijavite se ovde</a></h5>
        <?php
        }        
        ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="container search  center" style="width: 100%;">
            <form action="" method="GET">
                <input type="text" class="search-input" placeholder="Pretraži proizvode" name="input_search">
                <button class="search-button" name="name_search">Pretraži</button>
            </form>
        </div>
    </div>
</div>

<?php
    $sql = "SELECT * FROM products WHERE salesman='$username' AND customer=''";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){    
?>
    <div class="container">
        <div class="content">
            <div class="name">
            <?php echo "<a href='product-page-salesman.php?name=".$row['name']."'class='name'>"; ?>
            <p class="name"> <?php echo $row['name']; ?></p> <?php echo "</a>"; ?>
            </div>
            <?php echo "<a href='delete-product-check.php?name=".$row['name']."'>"; ?>
            <button class="btn btn-dark" type="submit">Izbriši</button>
            <?php echo "</a>"; ?>
            <?php echo "<a href='update-product-check.php?name=".$row['name']."'>"; ?>
            <button class="btn btn-dark" type="submit">Izmeni</button>
            <?php echo "</a>"; ?>
        </div>
    </div>

<?php
    }}
?>