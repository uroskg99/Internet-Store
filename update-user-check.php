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
    <link rel="stylesheet" href="update-user.css">
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

<div class="row">
    <div class="col-md-12 column">
        <a href="home-customer.php">Početna stranica</a>
        <div class="right-div">
            <h5>You are logged in as <?php echo $_SESSION['username']; ?>
            <a class="nav-link dropdown-toggle right-a" href="#" id="navbardrop" data-toggle="dropdown">
                <img src="profile-pics/<?php echo $profilepic; ?>" width="40px" height="40px">
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.php">View Profile</a>
                <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
</div>



<div class="add" id="add">
<h3>Izmena podataka o korisniku</h3><br>
<form action="" method="POST" enctype="multipart/form-data">
       <label for="update_name">Ime:</label>
       <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Unesi ime korisnika:" name="update_user_name"><br>
          <button class="btn btn-dark" type="submit" name="button_update_user_name" onclick='return check()'>Izmeni ime</button><br><br>
       </div>

       <label for="update_surname">Prezime:</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Unesi prezime korisnika:" name="update_user_surname"><br>
            <button class="btn btn-dark" type="submit" name="button_update_user_surname" onclick='return check()'>Izmeni prezime</button><br><br>
        </div>

        <label for="update_surname">Korisničko ime:</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Unesi korisničko ime:" name="update_username"><br>
            <button class="btn btn-dark" type="submit" name="button_update_username" onclick='return check()'>Izmeni korisničko ime</button><br><br>
        </div>

        <label for="update_email">Email:</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Unesi e-mail adresu:" name="update_email"><br>
            <button class="btn btn-dark" type="submit" name="button_update_email" onclick='return check()'>Izmeni email adresu</button><br><br>
        </div>

        <label for="password1">Lozinka:</label>


        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Unesi lozinku:" name="password1">
            <input type="text" class="form-control" placeholder="Ponovi lozinku:" name="password2"><br>
            <button class="btn btn-dark" type="submit" name="button_update_password" onclick='return check()'>Izmeni lozinku</button><br><br>
        </div>

        <label for="role">Korisnik je:</label>
        <div class="input-group mb-3">
           <select name="update_role" class="form-control">
              <option>Prodavac</option>
              <option>Kupac</option>
            </select>
            <br>
            <button class="btn btn-dark" type="submit" name="button_update_role" onclick='return check()'>Izmeni ulogu</button><br><br>
        </div>

        <label for="picture">Profilna fotografija:</label>
        <div class="input-group mb-3">
            <input type="file" name="picture">
            <button class="btn btn-dark" type="submit" name="button_update_picture" onclick='return check()'>Izmeni profilnu fotografiju</button><br><br>
        </div>


<?php
$msg = '';
$name = $_GET['name'];
$allowed = true;

if(isset($_POST['button_update_user_name'])){
    $user_name = $_POST['update_user_name'];
    $sql = "UPDATE users SET name = '$user_name' WHERE name = '$name'";
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
    $sql = "UPDATE users SET surname = '$user_surname' WHERE name = '$name'";
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
        $sql = "UPDATE users SET username = '$user' WHERE name = '$name'";
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
        $sql = "UPDATE users SET email = '$email' WHERE name = '$name'";
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
        $sql = "UPDATE users SET password = '$password1' WHERE name = '$name'";
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

    $sql = "UPDATE users SET role = '$update_role' WHERE name = '$name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        $msg = "Uspešno!";
    }else{
        $msg = "Neuspešno!";
    }
}


if(isset($_POST['button_update_picture'])){
    $picture = $_FILES['picture']['name'];
    $target = "user-pics/".basename($picture);

    if(!move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
        $msg = "Neuspešno!";
    }
    $sql = "UPDATE users SET profilepic = '$picture' WHERE name = '$name'";
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