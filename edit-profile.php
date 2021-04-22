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
    <link rel="stylesheet" href="edit-profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>
<body>

<?php

$msg = '';
$username_prim = $_SESSION['username'];
$qry = "SELECT * FROM users WHERE username='$username_prim' ";
$res = mysqli_query($conn, $qry);

while($row = mysqli_fetch_assoc($res)){
    $name = $row['name'];
    $surname = $row['surname'];
    $email = $row['email'];
    $password = $row['password'];
    $role = $row['role'];
    $profilepic = $row['profilepic'];
    $username = $row['username'];
}

if(isset($_POST['update_info'])){
    $name = $_POST['new_name'];
    $surname = $_POST['new_surname'];
    $username = $_POST['new_username'];
    $email = $_POST['new_email'];
    $_SESSION['username'] = $username;

    $sql = "UPDATE users SET `name` = '$name',
    `surname` = '$surname',
    `username` = '$username',
    `email` = '$email' WHERE username='$username_prim'";

    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:profile.php");
    }
}

if(isset($_POST['update_pass'])){
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $new_pass2 = $_POST['new_password2'];

    if($old_pass != $password){
        $msg = "Unesite tačnu trenutnu šifru!";
    }else if(strlen($new_pass) < 6){
        $msg = "Šifra je previše kratka! Izaberite šifru dužine od 6 do 30 karaktera";
    }else if(strlen($new_pass) > 31){
        $msg = "Šifra je previše dugačka! Izaberite šifru dužine od 6 do 30 karaktera";
    }else if($new_pass != $new_pass2){
        $msg = "Ponovite istu šifru!";
    }else{
        $sql = "UPDATE users SET password='$new_pass' WHERE username='$username_prim'";
        $res = mysqli_query($conn, $sql);

        if($res){
            header("location:profile.php");
        }
    }
}

if(isset($_POST['update_profilepic'])){
    $picture = $_FILES['picture']['name'];
    $target = "profile-pics/".basename($picture);

    if(!move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
        echo "ERROR";
    }

    $sql = "UPDATE users SET profilepic = '$picture' WHERE username='$username_prim'";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:profile.php");
    }
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

<h3>Ovde možete promeniti vaše lične podatke i vašu šifru</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-5">
            <div class="justify-content-center">
                <form action="" method="POST" class="form1" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Ime</label>
                        <input type="text" class="form-control" value=<?php echo $name;?> name="new_name" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Prezime</label>
                        <input type="text" class="form-control" value=<?php echo $surname;?> name="new_surname" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" value=<?php echo $username;?> name="new_username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value=<?php echo $email;?> name="new_email" required>
                    </div>
                    <button class="btn btn-primary" type="submit" name="update_info" onclick='return checkEdit()'>Ažuriraj lične podatke</button>
                </form>
            </div>
        </div>
        <div class="col-xl-3 col2">
            <div class="justify-content-center pic-center">
                <img src="profile-pics/<?php echo $profilepic; ?>" width="120px" height="120px" class="profile-pic">  
                <form action="" method="POST" enctype="multipart/form-data">
                    <input class="file" type="file" name="picture"><br>
                    <button class="btn btn-primary pic-update" name="update_profilepic" onclick='return checkEdit()'>Ažuriraj profilnu sliku</button>
                </form>  
            </div>
        </div>
        <div class="col-xl-4 col3">
            <form class="form2" action="" method="POST" enctype="multipart/form-data">
                <div class="hide" id="pass">
                    <div class="form-group">
                        <label>Trenutna šifra</label>
                        <input type="password" class="form-control" placeholder="Trenutna šifra" name="old_password" required>
                    </div>
                    <div class="form-group">
                        <label>Nova šifra</label>
                        <input type="password" class="form-control" placeholder="Nova šifra" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label>Ponovi novu šifru</label>
                        <input type="password" class="form-control" placeholder="Ponovi novu šifru" name="new_password2" required>
                    </div>
                <button class="btn btn-primary change-pass hide" id="change-pass" name="update_pass" onclick='return checkEdit()'>Ažuriraj šifru</button><br>
                </div>
            </form>
            <button class="btn btn-primary pass-button" id="pass-button">Promeni šifru</button><br>
            <?php echo $msg; ?>
        </div>
    </div>
</div>

<script>
    let passButton = document.getElementById('pass-button');
    let passDiv = document.getElementById('pass');
    let changePassButton = document.getElementById('change-pass');
    passButton.addEventListener('click', showInputs);

    function showInputs(){
        passDiv.classList.remove('hide');
        changePassButton.classList.remove('hide');
        passButton.classList.add('hide');
    }

    function checkEdit(){
        return confirm('Molimo vas, potvrdite ako ste sigurni da želite da promenite vaše lične podatke!');
    }
</script>

</body>
</html>