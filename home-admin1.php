<?php

include 'config.php';
session_start();

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'salesperson'){
        header("location:home-salesman.php");
    }else if($_SESSION['role'] == 'customer'){
        header("location:home-customer.php");
    }
}

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
    <link rel="stylesheet" href="home-admin1.css">
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
        <a href="home-admin1.php">
            <img src="website-pics/logo.png" class="logo">
        </a>
    <div class="right-div">
    <h5>Ulogovani ste kao <?php echo $_SESSION['username']; ?></h5>
    <a class="nav-link dropdown-toggle right-a" href="#" id="navbardrop" data-toggle="dropdown">
        <img src="profile-pics/<?php echo $profilepic; ?>" width="45px" height="45px" class="mini-profile">
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="home-admin1.php">Početna stranica</a>
        <a class="dropdown-item" href="admin-profile.php">Pogledaj Profil</a>
        <a class="dropdown-item" href="edit-profile-admin.php">Izmeni Profil</a>
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
    <a href="add-user.php">
    <button class="search-button2">Klikni ovde da dodaš korisnika</button>
    </a>
</div>



    <?php 
        $r = "Admin";
        $product_qry = "SELECT * FROM users WHERE role!='admin'";

        $product_res = mysqli_query($conn, $product_qry);
        $res = mysqli_num_rows($product_res);
    ?>

    <?php 
    
    if($res == 0){
        echo "Nema rezultata";
    }else{
        while($product_data = mysqli_fetch_assoc($product_res)){
            if($product_data['role']=='customer'){
                $r = 'Kupac';
            }
            else if($product_data['role']=='salesperson'){
                $r = 'Prodavac';
            }
        ?>
        <div class="container product">
                <img src="profile-pics/<?php echo $product_data['profilepic']; ?>" width="" height="100%" class="product-pic">
                <br><p class="name">Korisnik <?php echo $product_data['name']." ".$product_data['surname']; ?>
                <div class="price"><?php echo $r; ?></div><br>
                <div class="left">Korisničko ime: <?php echo "@".$product_data['username']; ?></div>
                <p class="left">Email: <?php echo $product_data['email']; ?>
        </div>

        <div class="buttons">
            <?php echo "<a href='delete-user-check.php?username=".$product_data['username']."'>"; ?>
            <button class="search-button1" type="submit">Izbriši</button>
            <?php echo "</a>"; ?>
            <?php echo "<a href='update-user-check.php?username=".$product_data['username']."'>"; ?>
            <button class="search-button" type="submit">Izmeni</button><br><br>
            <?php echo "</a>"; ?>
        </div>

        <?php
            
        }
    }
    ?> 
</div>
</body>
</html>