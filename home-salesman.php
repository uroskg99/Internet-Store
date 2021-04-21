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
    <link rel="stylesheet" href="home-salesman.css">
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
        <a href="home-salesman.php">
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


<div class="search">
    <a href="next-salesman.php">
    <button class="search-button2">Klikni ovde da pregledaš prodajne artikle</button>
    </a>
</div>

<div class="search">
    <a href="upload-product.php">
    <button class="search-button2">Klikni ovde da postaviš oglas</button>
    </a>
</div>

<div class="search">
    <a href="view-product.php">
    <button class="search-button2">Klikni ovde da pregledaš porudžbine</button>
    </a>
</div>
