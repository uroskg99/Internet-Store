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
    <link rel="stylesheet" href="home-customers.css">
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

<nav class="navbar navbar-expand-sm fixed-top">
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="home-customer.php">Home Page</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Link 2</a>
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

</body>
</html>