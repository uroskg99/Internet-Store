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
</div>

<?php 

$prod_name = mysqli_real_escape_string($conn, $_GET['name']);
/*
predstaviti sve detalje proizvoda

opcija za customer-a da kupi proizvod, klikom na to dugme ga salje u njegove porudzbine i tu dodaje ovaj proizvod,
takodje u bazi podataka u tabeli products, polje 'kupac' upisuje se username kupca

kupljeni proizvod ne bi trebalo da bude predstavljen kao dostupan proizvod za druge kupce
*/
?>
</body>
</html>