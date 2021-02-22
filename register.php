<?php
//include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Internet Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
        </div>
        <div class="form-group">
            <label for="surname">Surame:</label>
            <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass" placeholder="Enter password" name="password" required>
        </div>
        <div class="form-group">
            <label for="pass2">Repeat password:</label>
            <input type="password" class="form-control" id="pass2" placeholder="Repeat password" name="password2" required>
        </div>
        <div class="form-group">
            <label for="salesperson">Salesperson</label>
            <input type="radio" id="salesperson" name="role" value="salesperson">
            <br>
            <label for="customer">Customer</label>
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
            

            if(strlen($password) < 6){
                $msg = "Password too weak! Must be between 6 and 30 characters";
                $allowed = false;
            }else if(strlen($password) > 31){
                $msg = "Password too weak! Must be between 6 and 30 characters";
                $allowed = false;
            }

            if($password != $password2){
                $msg = "Repeat the same password!";
                $allowed = false;
            }

            $qry_register = "SELECT username, email FROM users";
            $result = mysqli_query($conn, $qry_register);
            while($row = mysqli_fetch_array($result)){
                if($username == $row['username'] || $email == $row['email']){
                    $msg = "User with the same username or email already exists!";
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

        <button type="submit" class="btn btn-primary" name="register">Register</button>
    </form>
    <a href="sign.php">
        <small id="registered">Already registered? Click here to sign in</small><br>
    </a>
    <?php echo $msg; ?>
</div>


</body>
</html>