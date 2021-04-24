<?php

include 'config.php';
session_start();

if(!isset($_SESSION['role'])){
    header("location:sign.php");
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
    <link rel="stylesheet" href="salesman-profile.css">
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
    $email = $row['email'];
    $password = $row['password'];
    $role = $row['role'];
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
            <a class="dropdown-item" href="home-salesman1.php">Početna stranica</a>
            <a class="dropdown-item" href="salesman-profile.php">Pogledaj Profil</a>
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

<?php } ?>


<div class="container user-profile">
    <div class="picture"><img src="profile-pics/<?php echo $profilepic; ?>" width="150px" height="150px" class="profile-pic"></div>
    <ul class="list-group">
        <li class="list-group-item"><span>Ime: </span><?php echo $name; ?></li>
        <li class="list-group-item"><span>Prezime: </span><?php echo $surname; ?></li>
        <li class="list-group-item"><span>Username: </span><?php echo $username; ?></li>
        <li class="list-group-item"><span>Email: </span><?php echo $email; ?></li>
        <li class="list-group-item"><span>Vi ste: </span><?php echo $role; ?></li>
    </ul>

</div> 

<?php

$comm_qry = "SELECT * FROM comments WHERE toWho = '$username' ";
$qry_res = mysqli_query($conn, $comm_qry);
$comm_num = mysqli_num_rows($qry_res);

?>

<div class="comments">
    <h4>Ocene i komentari prodavca</h4>

    <?php

    if($comm_num == 0){
        echo "<h3>Ovaj prodavac nema komentare</h3>";
    }else{
        echo "<h3>Ovaj prodavac ima ukupan broj utisaka: " . $comm_num . "</h3>";
        while($row_comm = mysqli_fetch_array($qry_res)){
            $productId = $row_comm['productId'];
            $fromWho = $row_comm['fromWho'];
            $toWho = $row_comm['toWho'];
            $comment = $row_comm['comment'];
            $rate = $row_comm['rate'];
            
            $prod_qry = "SELECT * FROM products WHERE id = '$productId' ";
            $prod_res = mysqli_query($conn, $prod_qry);
            $row_prod = mysqli_fetch_assoc($prod_res);

            $prodName = $row_prod['name'];

            ?>

            <div class="rate-div">
                <p>Ovaj komentar je ostavio kupac <span class="bold"><?php echo $fromWho; ?></span> za proizvod <span class="bold"><?php echo $prodName; ?></span></p>
                <div>
                    <p class="rate">Kupac je dao ocenu: <span class="bold"><?php echo $rate; ?></span></p>
                    <p class="comm"><?php echo $comment; ?></p>
                </div>
            </div>

            <?php
        }
    }

    ?>
</div>

</body>
</html>