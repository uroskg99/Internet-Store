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
    <link rel="stylesheet" href="rate-salesman.css">
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
    </div>
</div>

<?php
$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql_product = "SELECT * FROM products WHERE id='$id' ";
$result_product = mysqli_query($conn, $sql_product);

$row = mysqli_fetch_assoc($result_product);


if(isset($_POST['not-rate'])){
    $value = "yes";
    $bought = "";
    $qry = "UPDATE products SET `delievered` = '$value' WHERE id='$id' ";
    $qry2 = "UPDATE products SET `customer` = '$bought' WHERE id='$id' ";
    mysqli_query($conn, $qry);
    mysqli_query($conn, $qry2);
    header("location:salesman-profile.php?salesman-name=".$row['salesman']." ");
}

if(isset($_POST['submit-rate'])){
    $comment = $_POST['comment'];
    $fromWho = $_SESSION['username'];
    $toWho = $row['salesman'];
    $productId = $id;

    $rate = $_POST['rate'];

    $sqlComm = "INSERT INTO comments (productId,fromWho,toWho,comment,rate) VALUES ('$productId', '$fromWho', '$toWho', '$comment', '$rate')";
    $value = "yes";
    $bought = "";
    $qry = "UPDATE products SET `delievered` = '$value' WHERE id='$id' ";
    $qry2 = "UPDATE products SET `customer` = '$bought' WHERE id='$id' ";
    mysqli_query($conn, $qry);
    mysqli_query($conn, $qry2);
    mysqli_query($conn, $sqlComm);
    header("location:salesman-profile.php?salesman-name=".$row['salesman']." ");
}

?>

<div class="container">
    <h4>Ovde možete podeliti iskustva sa prodavcem <span class="rate-span"><?php echo $row['salesman']; ?></span>, u vezi proizvoda <span class="rate-span"><?php echo $row['name']; ?></span></h4>
    <h6>Pritiskom na ovo dugme samo potvrđujete isporuku proizvoda</h6>
    <form action="" method="POST">
        <button id="not-rate" class="rate" name="not-rate" onclick='return checkDelievery()'>Potvrdi porudžbinu</button>
    </form>
    <h6>Pritiskom na ovo dugme potvrđujete isporuku proizvoda i možete podeliti bilo kakve utiske vezane za proizvod i poslodavca</h6>
    <button id="rate" class="rate" onclick='return openPopup()'>Potvrdi porudžbinu i oceni</button>
</div>

<div id="popup" class="hide">
    <div class="popup">
        <div class="popup-content">

            <div id="rate-salesman" class="rate-salesman">
                <button id="close2" class="close" onclick='return closePopup()'>X</button>

                <form action="" method="POST">
                    <div class="form-group">
                        <label for="comment" class="rate-label">Dodajte vaš komentar:</label>
                        <textarea type="text" class="form-control" name="comment" cols="55" rows="5" placeholder="Komentar" reuired></textarea>
                    </div>
                    <div class="rate-div">
                        <div class="form-group">
                            <label for="rate" class="rate-label for-rate">Ocenite prodavca ocenom (1-5)</label>
                            <input type="number" step="1" min="1" max="5" class="form-control input-rate" placeholder="Ovde unesite ocenu za prodavca" name="rate" required>
                        </div>
                        <button type="submit" class="rate" name="submit-rate" onclick='return checkDelievery()'>Sačuvaj utisak i ocenu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
<script>

let popup = document.getElementById("popup");
let body = document.getElementsByTagName("BODY")[0];

function openPopup(){
    popup.classList.remove("hide");
    body.classList.add("no-scroll");
}

function closePopup(){
    popup.classList.add("hide");
    body.classList.remove("no-scroll");
}

function checkDelievery(){
    return confirm('Da li ste sigurni da želite da potvrdite porudžbinu bez komentara i ocene, nema mogućnosti povratka.');
}

function checkDelievery2(){
    return confirm('Da li ste sigurni da želite da sačuvate utisak i ocenu za prodavca?');
}


</script>


</body>
</head>        