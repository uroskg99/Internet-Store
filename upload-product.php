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

<div class="container-fluid navigation">
    <div class="container search">
        <form action="" method="GET">
            <input type="text" class="search-input" placeholder="Pretraži proizvode" name="input_search">
            <button class="search-button" name="name_search">Pretraži</button>
        </form>
    </div>

    <nav class="navbar navbar-expand-sm">
        <ul class="navbar-nav">
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
                    <a class="dropdown-item" href="orders.php">My orders</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="home-customer.php">Home Page</a>
            </li>
        </ul>
    </nav>
<br>
</div>


<div class="container formSignUp">
<h3>Postavljanje oglasa</h3>
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
              <option disabled selected>Izaberi valutu: </option>
              <option>euro</option>
              <option>din</option>
            </select>
           </div>
        </div>

        <div class="form-group">
            <label for="quantity">Količina</label>
            <input type="text" class="form-control" placeholder="Unesi količinu:" name="quantity" required>
        </div>
        
       <input type='file' name='file[]' id='file' multiple> 
       <button type="submit"  name="add_product">Potvrdi</button>

</form>
</div>
</body>
</html>
