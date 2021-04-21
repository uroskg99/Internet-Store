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

<div class="row search-row">
                <div class="col-md-12">
                    <div class="container search center" style="width: 100%;">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input type="text" class="search-input form-control" placeholder="Pretraži proizvode" name="input_search">
                                <div class="input-group-appen">
                                    <button class="search-button" name="name_search">Pretraži</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
    if(isset($_GET['name_search'])){
        $search = mysqli_real_escape_string($conn, $_GET['input_search']);
        $sql = "SELECT * FROM products WHERE name LIKE '%$search%' AND customer != '' AND salesman='$username' AND sold='' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
    }
    else{
        $sql = "SELECT * FROM products WHERE salesman='$username' AND customer!='' AND sold='' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
    }

    if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){    
?>
    <div class="container">
        <div class="content">
            <div class="name">
            <?php echo "<a href='product-page-salesman.php?name=".$row['name']."'class='name'>"; ?>
            <p class="name"> <?php echo $row['name']; ?></p> <?php echo "</a>"; ?>
            </div>
            <?php echo "<a href='submit-product-check.php?name=".$row['name']."'>"; ?>
            <button class="btn btn-dark" type="submit" onclick='return submitProduct()'>Potvrdi</button>
            <?php echo "</a>"; ?>
            <?php echo "<a href='cancel-product-check.php?name=".$row['name']."'>"; ?>
            <button class="btn btn-dark" type="submit" onclick='return cancelProduct()'>Otkaži</button>
            <?php echo "</a>"; ?>
        </div>
    </div>

<?php
    }}
?>


<script>
    function cancelProduct(){
        return confirm('Da li ste sigurni da želite da otkažete porudžbinu?');
    }
    function submitProduct(){
        return confirm('Da li ste sigurni da želite da potvrdite porudžbinu?');
    }
</script>