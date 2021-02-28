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
    <link rel="stylesheet" href="edit-profile.css">
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

if(isset($_POST['update_name'])){
    $name = $_POST['new_name'];
    $sql = "UPDATE users SET name='$name' WHERE username='$username_prim'";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:profile.php");
    }
}

if(isset($_POST['update_surname'])){
    $surname = $_POST['new_surname'];
    $sql = "UPDATE users SET surname='$surname' WHERE username='$username_prim'";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:profile.php");
    }
}

if(isset($_POST['update_username'])){
    $username = $_POST['new_username'];
    $sql = "UPDATE users SET username='$username' WHERE username='$username_prim'";
    $res = mysqli_query($conn, $sql);

    if($res){
        $_SESSION['username'] = $username;
        header("location:profile.php");
    }
}

if(isset($_POST['update_email'])){
    $email = $_POST['new_email'];
    $sql = "UPDATE users SET email='$email' WHERE username='$username_prim'";
    $res = mysqli_query($conn, $sql);

    if($res){
        header("location:profile.php");
    }
}

if(isset($_POST['update_pass'])){
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $new_pass2 = $_POST['new_password2'];

    if($old_pass == $password){
        $sql = "UPDATE users SET password='$new_pass' WHERE username='$username_prim'";
        $res = mysqli_query($conn, $sql);

    
    }

}


?>
<div class="container-fluid">
    <nav class="navbar navbar-expand-sm fixed-top">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="home-customer.php">Home Page</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Link 2</a>
            </li>
            <li class="nav-item">
                <h5>You are logged in as <?php echo $_SESSION['username']; ?>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <img src="profile-pics/<?php echo $profilepic; ?>" width="40px" height="40px">
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php">View Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="#">My orders</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
</div>

<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Here you can edit your personal informations and change password!</h3>
        <p>Name</p><input type="text" name="new_name" value=<?php echo $name; ?>>
        <button class="btn btn-primary" name="update_name" onclick='return checkEdit()'>Update name</button>

        <p>Surname</p><input type="text" name="new_surname" value=<?php echo $surname; ?>>
        <button class="btn btn-primary" name="update_surname" onclick='return checkEdit()'>Update surname</button>

        <p>Username</p><input type="text" name="new_username" value=<?php echo $username; ?>>
        <button class="btn btn-primary" name="update_username" onclick='return checkEdit()'>Update username</button>

        <p>Email</p><input type="text" name="new_email" value=<?php echo $email; ?>>
        <button class="btn btn-primary" name="update_email" onclick='return checkEdit()'>Update email</button>
    </form>
    <div class="right-side">
        <img src="profile-pics/<?php echo $profilepic; ?>" width="120px" height="120px">
        <button class="btn btn-primary">Upload another picture</button>
        <div class="password">
            <div class="hide" id="pass">
                <p>Current password</p><input type="password" name="old_password">
                <p>New password</p><input type="password" name="new_password">
                <p>Repeat new password</p><input type="password" name="new_password2"><br>
            </div>
            <button class="btn btn-primary pass-button" id="pass-button">Change password</button><br>
            <form action="" method="POST" enctype="multipart/form-data">
                <button class="btn btn-primary change-pass hide" id="change-pass" name="update_pass" onclick='return checkEdit()'>Update password</button>
            </form>
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
        return confirm('Please, confirm if You are sure You want to edit your personal informations!');
    }
</script>

</body>
</html>