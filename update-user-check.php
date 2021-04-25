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
<h3>Ažuriranje korisnika</h3><br>
<form action="" method="POST" enctype="multipart/form-data">
       <div class="form-group">
          <label for="update_user_name">Ime</label>
          <input type="text" class="form-control" placeholder="Ažuriraj ime korisnika:" name="update_user_name"><br>
          <button class="btn" type="submit" name="button_update_user_name" onclick='return check()'>Ažuriraj</button><br><br>
       </div>

        <div class="form-group">
            <label for="update_user_surname">Prezime</label>
            <input type="text" class="form-control" placeholder="Ažuriraj prezime korisnika:" name="update_user_surname"><br>
            <button class="btn" type="submit" name="button_update_user_surname" onclick='return check()'>Ažuriraj</button><br><br>
        </div>

        <div class="form-group">
            <label for="update_username">Korisničko ime</label>
            <input type="text" class="form-control" placeholder="Ažuriraj korisničko ime:" name="update_username"><br>
            <button class="btn" type="submit" name="button_update_username" onclick='return check()'>Ažuriraj</button><br><br>
        </div>

        <div class="form-group">
            <label for="update_email">Email</label>
            <input type="text" class="form-control" placeholder="Ažuriraj e-mail adresu:" name="update_email"><br>
            <button class="btn" type="submit" name="button_update_email" onclick='return check()'>Ažuriraj</button><br><br>
        </div>

        <div class="form-group">
            <label for="password1">Lozinka</label>
            <input type="text" class="form-control" placeholder="Ažuriraj lozinku:" name="password1">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Ponovi lozinku:" name="password2"><br>
            <button class="btn" type="submit" name="button_update_password" onclick='return check()'>Ažuriraj</button><br><br>
        </div>

        <label for="role">Korisnik je</label>
        <div class="form-group">
           <select name="update_role" class="form-control">
              <option disabled selected>Ažuriraj ulogu: </option>
              <option>Prodavac</option>
              <option>Kupac</option>
            </select><br>
            <button class="btn" type="submit" name="button_update_role" onclick='return check()'>Ažuriraj</button><br><br>
        </div>
        
        <div class="form-group">
            <label for="picture">Profilna fotografija</label><br>
            <input type="file" name="picture">
            <button class="btn" type="submit" name="button_update_picture" onclick='return check()'>Ažuriraj</button><br><br><br>
        </div>


<?php
$msg = '';
$username = $_GET['username'];
$allowed = true;

if(isset($_POST['button_update_user_name'])){
    $user_name = $_POST['update_user_name'];
    $sql = "UPDATE users SET name = '$user_name' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(empty(trim($user_name))){
        $msg = "Space ne može biti neka od informacija!";
        $allowed = false;
    }

    if($allowed){
        $msg = "Uspešno!";
    }else{
        $msg = "Neuspešno!";
    }
}


if(isset($_POST['button_update_user_surname'])){
    $user_surname = $_POST['update_user_surname'];
    $sql = "UPDATE users SET surname = '$user_surname' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(empty(trim($user_surname))){
        $msg = "Space ne može biti neka od informacija!";
        $allowed = false;
    }

    if($allowed){
        $msg = "Uspešno!";
    }else{
        $msg = "Neuspešno!";
    }
}


if(isset($_POST['button_update_username'])){
    $user = $_POST['update_username'];
    
    $qry_register = "SELECT username FROM users";
    $result1 = mysqli_query($conn, $qry_register);
    while($row = mysqli_fetch_array($result1)){
        if($user == $row['username']){
            $msg = "Već postoji korisnik sa tim username-om!";
            $allowed = false;
            break;
        }
    }

    if(empty(trim($user))){
        $msg = "Space ne može biti neka od informacija!";
        $allowed = false;
    }

    if($allowed){
        $sql = "UPDATE users SET username = '$user' WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
    }
}


if(isset($_POST['button_update_email'])){
    $email = $_POST['update_email'];

    $qry_register = "SELECT email FROM users";
    $result1 = mysqli_query($conn, $qry_register);
    while($row = mysqli_fetch_array($result1)){
        if($email == $row['email']){
            $msg = "Već postoji korisnik sa tim email-om!";
            $allowed = false;
            break;
        }
    }

    if(empty(trim($email))){
        $msg = "Space ne može biti neka od informacija!";
        $allowed = false;
    }

    if($allowed){
        $sql = "UPDATE users SET email = '$email' WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
    }
}


if(isset($_POST['button_update_password'])){
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

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

    if($allowed){
        $sql = "UPDATE users SET password = '$password1' WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $msg = "Uspešno!";
    }

}

if(isset($_POST['button_update_role'])){
    $update_role = $_POST['update_role'];

    if($update_role == 'Prodavac'){
        $update_role = 'salesperson';
    }
    else{
        $update_role = 'customer';
    }

    $sql = "UPDATE users SET role = '$update_role' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if($result){
        $msg = "Uspešno!";
    }else{
        $msg = "Neuspešno!";
    }
}


if(isset($_POST['button_update_picture'])){
    $picture = $_FILES['picture']['name'];
    $target = "profile-pics/".basename($picture);

    if(!move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
        $msg = "Neuspešno!";
    }
    $sql = "UPDATE users SET profilepic = '$picture' WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if($result){
        $msg = "Uspešno!";
    }else{
        $msg = "Neuspešno!";
    }
}
?>

</form>
<p class="error-msg"><?php echo $msg; ?></p><br>
</div>
</body>
</html>

<script>
    function check(){
        return confirm('Da li ste sigurni?');
    }
</script>