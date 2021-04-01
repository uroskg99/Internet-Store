<?php

include 'config.php';
session_start();

$salesman_name = mysqli_real_escape_string($conn, $_GET['salesman-name']);
$sql_sales = "SELECT * FROM users WHERE username='$salesman_name' ";
$res_sales = mysqli_query($conn, $sql_sales);

while($row_sales = mysqli_fetch_assoc($res_sales)){
    $name_sales = $row_sales['name'];
    $surname_sales = $row_sales['surname'];
    $profilepic_sales = $row_sales['profilepic'];
    $username_sales = $row_sales['username'];
    $email_sales = $row_sales['email'];
    $role_sales = $row_sales['role'];
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

<?php } ?>

<h4>Trenutno gledate profil prodavca: <?php echo $name_sales . ' ' . $surname_sales; ?></h4>

<div class="container user-profile">
    <div class="picture"><img src="profile-pics/<?php echo $profilepic_sales; ?>" width="150px" height="150px" class="profile-pic"></div>
    <ul class="list-group">
        <li class="list-group-item"><span>Ime: </span><?php echo $name_sales; ?></li>
        <li class="list-group-item"><span>Prezime: </span><?php echo $surname_sales; ?></li>
        <li class="list-group-item"><span>Username: </span><?php echo $username_sales; ?></li>
        <li class="list-group-item"><span>Email: </span><?php echo $email_sales; ?></li>
        <li class="list-group-item"><span>Vi ste: </span><?php echo $role_sales; ?></li>
    </ul>
</div> 

<div class="comments">
    <h4>Ocene i komentari prodavca</h4>
</div>

</body>
</html>