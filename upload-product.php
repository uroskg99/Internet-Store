<?php
include 'config.php';
session_start();

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){
        header("location:home-admin.php");
    }else if($_SESSION['role'] == 'customer'){
        header("location:home-customer.php");
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
        <a href="home-salesman1.php">
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
        <a class="dropdown-item" href="orders.php">Moji proizvodi</a>
        <a class="dropdown-item" href="orders.php">Čeka se za slanje</a>
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
<h3>Ovde možete postaviti oglas</h3><br>
<form action="upload-product-check.php" method="POST" enctype="multipart/form-data">
       <div class="form-group">
          <label for="product_name">Naziv oglasa</label>
          <input type="text" class="form-control" placeholder="Unesi naziv oglasa:" name="product_name" required>
       </div>

       <div class="form-group">
        <label for="type">Kategorija</label>
        <select name="type" class="form-control">
           <option disabled selected>Unesi kategoriju: </option>
           <option>Antikviteti</option>
           <option>Audio</option>
           <option>Automobili</option>
           <option>Bela tehnika</option>
           <option>Bicikli</option>
           <option>Domaća hrana</option>
           <option>Dvorište i bašta</option>
           <option>Elektronika</option>
           <option>Igračke i knjige</option>
           <option>Knjige</option>
           <option>Kompjuteri</option>
           <option>Konzole i igrice</option>
           <option>Kućni ljubimci</option>
           <option>Mobilni telefoni</option>
           <option>Motocikli</option>
           <option>Muzika i instrumenti</option>
           <option>Nakit, satovi</option>
           <option>Nameštaj</option>
           <option>Nekretnine</option>
           <option>Odeća</option>
           <option>Sport</option>
           <option>TV i Video</option>
        </select>
       </div>

        <div class="form-group">
            <label for="location">Lokacija</label>
            <input type="text" class="form-control" placeholder="Unesi lokaciju:" name="location" required>
        </div>

        <div class="form-group">
            <label for="description">Tekst oglasa</label>
            <textarea type="text" class="form-control" name="description" cols="55" rows="5" placeholder="Unesi tekst oglasa:" required></textarea>
        </div>

        <label for="price">Cena</label>
        <div class="form-group row">
         <div class="col-sm-6">
           <input type="text" class="form-control" placeholder="Unesi cenu:" name="price" required>
          </div>
          <div class="col-sm-3">
           <select name="currency" class="form-control">
              <option disabled selected>Valuta: </option>
              <option>euro</option>
              <option>din</option>
            </select>
           </div>
        </div>

        <div class="form-group">
            <label for="quantity">Količina</label>
            <input type="text" class="form-control" placeholder="Unesi količinu:" name="quantity" required><br>
        </div>
        
       <input type='file' name='file[]' id='file' multiple>
       <button type="submit" class="btn" name="add_product" onclick='return checkOrder()'>Potvrdi</button>

</form>

</div>
</body>
</html>

<script>
    function checkOrder(){
        return confirm('Da li ste sigurni da želite da postavite ovaj oglas?');
    }
</script>

