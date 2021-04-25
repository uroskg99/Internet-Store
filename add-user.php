<?php

include 'config.php';
session_start();

if(!isset($_SESSION['role'])){
    header("location:sign.php");
}

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'customer'){
        header("location:home-customer.php");
    }else if($_SESSION['role'] == 'salesperson'){
        header("location:home-salesman1.php");
    }
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
    <link rel="stylesheet" href="home-salesman1.css">
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


<div class="container formSignUp"><br>
<h3>Ovde možete dodati korisnika</h3><br>
<form action="add-user.php" method="POST" enctype="multipart/form-data">
       <div class="form-group">
          <label for="user_name">Ime</label>
          <input type="text" class="form-control" placeholder="Unesi ime korisnika:" name="user_name" required>
       </div><br>

        <div class="form-group">
            <label for="user_surname">Prezime</label>
            <input type="text" class="form-control" placeholder="Unesi prezime korisnika:" name="user_surname" required>
        </div><br>

        <div class="form-group">
            <label for="username">Korisničko ime</label>
            <input type="text" class="form-control" placeholder="Unesi korisničko ime:" name="username" required>
        </div><br>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" placeholder="Unesi e-mail adresu:" name="email" required>
        </div><br>

        <div class="form-group">
            <label for="password1">Lozinka</label>
            <input type="text" class="form-control" placeholder="Unesi lozinku:" name="password1" required>
        </div>

        <div class="form-group">
            <label for="password2">Ponovi lozinku</label>
            <input type="text" class="form-control" placeholder="Ponovi lozinku:" name="password2" required>
        </div><br>

        <div class="form-group">
            <label for="picture">Profilna fotografija</label><br>
            <input type="file" name="picture">
        </div><br>

        <label for="role">Korisnik je</label>
        <div class="form-group">
           <select name="role" class="form-control">
              <option disabled selected>Izaberi ulogu: </option>
              <option>Prodavac</option>
              <option>Kupac</option>
            </select>
        </div>
        

        <?php
include 'config.php';

$msg = '';

if(isset($_POST['add_user'])) {
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_name = validate($_POST['user_name']);
    $user_surname = validate($_POST['user_surname']);
    $username = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password1 = validate($_POST['password1']);
    $password2 = validate($_POST['password2']);
    $role = validate($_POST['role']);
    $picture = $_FILES['picture']['name'];
    $target = "profile-pics/".basename($picture);
    
    if(!move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
        echo "ERROR";
    }

    if($role == 'Prodavac'){
        $role = 'salesperson';
    }
    else{
        $role = 'customer';
    }

    $allowed = true;
            
    if(empty(trim($user_name)) || empty(trim($user_surname)) || empty(trim($username))){
        $msg = "Space ne može biti neka od informacija!";
        $allowed = false;
    }

    if(strlen($password1) < 6){
        $msg = "Šifra je previše kratka! Izaberite šifru dužine od 6 do 30 karaktera";
        $allowed = false;
    }else if(strlen($password1) > 31){
        $msg = "Šifra je previše dugačka! Izaberite šifru dužine od 6 do 30 karaktera";
        $allowed = false;
    }

    if($password1 != $password2){
        $msg = "Ponovite istu šifru!";
        $allowed = false;
    }

    $qry_register = "SELECT username, email FROM users";
    $result = mysqli_query($conn, $qry_register);
    while($row = mysqli_fetch_array($result)){
        if($username == $row['username'] || $email == $row['email']){
            $msg = "Već postoji korisnik sa tim email-om ili username-om!";
            $allowed = false;
            break;
        }
    }

    if($allowed){
        $qry_insert = "INSERT INTO users (name,surname,username,email,password,role,profilepic) VALUES ('$user_name', '$user_surname', '$username', '$email', '$password1', '$role', '$picture')";
        mysqli_query($conn, $qry_insert);
        header("location:home-admin1.php");
    }

}

?>
       <br>
       <button type="submit" class="btn" name="add_user" onclick='return checkUser()'>Potvrdi</button>
       </div>
</form>
<p class="error-msg"><?php echo $msg; ?></p><br>
</div>
</body>
</html>

<script>
    function checkUser(){
        return confirm('Da li ste sigurni da želite da dodate korisnika?');
    }
</script>
