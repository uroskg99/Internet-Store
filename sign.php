<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In With Internet Store- Internet Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<?php   
    if(isset($_POST['login'])){
        $login = $_POST['user'];
        $pass = $_POST['password'];
        $qry = "SELECT user_name, email, password, admin FROM users";
        $res = mysqli_query($conn, $qry);

        while($row=mysqli_fetch_array($res)){
            $username = $row['user_name'];
            $email = $row['email'];
            $password = $row['password'];
            $role = $row['role'];
            if($login == $row['user_name'] or $login == $row['email']){
                if($pass == $row['password']){
                    if($role == "admin"){
                        header("location:home-admin.php");
                    }else{
                        header("location:home-user.php");
                    }
                    session_start();
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['admin'] = $row['role'];
                    $_SESSION['username'] = $row['user_name'];
                    $_SESSION['isLogged'] = true;
                 }
            }else{
                //
        }
    }
}

?>
<body>
    <form action="sign.php" method="post">
      <p class="start">Sing-In</p>
      <div class="form-group">
           <label for="user">Email or username:</label>
           <input type="text" id="user" placeholder="Enter email or username" name="user" required><br>
      </div>
      <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" placeholder="Enter password" name="password" required><br>
      </div>
      <button type="submit" name="login">Sing In</button>
      <a href="register.php">Create an account </a>
    </form>
</body>
</html>
