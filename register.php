<?php

session_start();
include 'config.php';

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == "admin"){
        header("location:home-admin.php");
    }else if($_SESSION['role'] == "customer"){
        header("location:home-customer.php");
    }else{
        header("location:home-salesman.php");
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
    <link rel="stylesheet" href="register.css">
</head>

<body>
<div class="container-fluid header">
    <a href="home-customer.php">
        <img src="website-pics/logo.png" class="logo">
    </a>
</div>

<div class="container-fluid form">
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Ime:</label>
            <input type="text" class="form-control" id="name" placeholder="Unesi ime" name="name" required>
        </div>
        <div class="form-group">
            <label for="surname">Prezime:</label>
            <input type="text" class="form-control" id="surname" placeholder="Unesi prezime" name="surname" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Unesi username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Unesi email" name="email" required>
        </div>
        <div class="form-group">
            <label for="pass">Šifra:</label>
            <input type="password" class="form-control" id="pass" placeholder="Unesi šifru" name="password" required>
        </div>
        <div class="form-group">
            <label for="pass2">Ponovi šifru:</label>
            <input type="password" class="form-control" id="pass2" placeholder="Ponovi šifru" name="password2" required>
        </div>
        <div class="form-group">
            <label for="salesperson">Prodavac</label>
            <input type="radio" id="salesperson" name="role" value="salesperson">
            <br>
            <label for="customer">Kupac</label>
            <input type="radio" id="customer" name="role" value="customer" checked="checked">
        </div>

        <?php
        include 'config.php';
        $msg = '';
        
        if(isset($_POST['register'])){
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $role = $_POST['role'];


            $allowed = true;
            
            if(empty(trim($name)) || empty(trim($surname)) || empty(trim($username))){
                $msg = "Space ne može biti neka od informacija!";
                $allowed = false;
            }

            if(strlen($password) < 6){
                $msg = "Šifra je previše kratka! Izaberite šifru dužine od 6 do 30 karaktera";
                $allowed = false;
            }else if(strlen($password) > 31){
                $msg = "Šifra je previše dugačka! Izaberite šifru dužine od 6 do 30 karaktera";
                $allowed = false;
            }

            if($password != $password2){
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
                $qry_insert = "INSERT INTO users (name,surname,username,email,password,role) VALUES ('$name', '$surname', '$username', '$email', '$password', '$role')";
                mysqli_query($conn, $qry_insert);
                header("location:sign.php");
            }

        }

        ?>

        <button type="submit" class="btn btn-primary" name="register">Registruj se</button><br><br>
        <a href="sign.php">
            Već si registrovan? Klikni ovde da se prijaviš.
        </a>
    </form>
    <p class="error-msg"><?php echo $msg; ?></p>
</div>


</body>
</html>