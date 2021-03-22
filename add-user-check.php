<?php
include 'config.php';
session_start();

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
    $target = "user-pics/".basename($picture);
    
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
        $qry_insert = "INSERT INTO users (name,surname,username,email,password,role,profilepic) VALUES ('$user_name', '$user_surname', '$username', '$email', '$password', '$role', '$picture')";
        mysqli_query($conn, $qry_insert);
        header("location:home-admin.php");
    }

}

?>


