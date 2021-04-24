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
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>
<body>

<?php

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
    </div>
</div>

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

</body>
</html>