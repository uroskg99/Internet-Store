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
    <title>Sign In With Internet Store- Internet Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="sign.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>

<?php   
    $msg = '';
    if(isset($_POST['login'])){
        $login = $_POST['user'];
        $pass = $_POST['password'];
        $qry = "SELECT name, surname, username, email, password, role FROM users";
        $res = mysqli_query($conn, $qry);

        while($row = mysqli_fetch_array($res)){
            $username = $row['username'];
            $email = $row['email'];
            $password = $row['password'];
            $role = $row['role'];
            if($login == $row['username'] or $login == $row['email']){
                if($pass == $row['password']){

                    session_start();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = $role;

                    if($role == "admin"){
                        header("location:home-admin1.php");
                    }else if($role == "customer"){
                        header("location:home-customer.php");
                    }else{
                        header("location:home-salesman1.php");
                    }  
                }else{
                    $msg = 'Pogrešno ste uneli vaše informacije ili šifru!';
                }
            }else{
                $msg = 'Pogrešno ste uneli vaše informacije ili šifru!';
            }
        }
    }

?>
<body>
<div class="container-fluid header">
    <a href="home-customer.php">
        <img src="website-pics/logo.png" class="logo">
    </a>
</div>
<p class="error-msg"><?php echo $msg; ?></p>
<div class="container-fluid">
    <div class="justify-content-center">
        <form action="sign.php" method="post">
            <div class="form-group">
                <label for="username">Email ili username</label>
                <input type="text" class="form-control" placeholder="Unesite vaš email ili username" name="user" required>
                <small class="form-text text-muted">Nećemo deliti vašu email adresu</small>
            </div>
            <div class="form-group">
                <label for="username">Šifra</label>
                <input type="password" class="form-control" placeholder="Unesi vašu šifru" name="password" required>
            </div>
            <button class="btn btn-primary" type="submit" name="login">Prijavi se</button><br><br><br>
            <a href="register.php">Kreirajte novi nalog</a>
        </form>     
    </div>
</div>

</body>
</html>
