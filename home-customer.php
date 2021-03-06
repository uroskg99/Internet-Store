<?php

include 'config.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Internet Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="home-customers.css">
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
    <nav class="navbar navbar-expand-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="home-customer.php">Home Page</a>
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
<br>
</div>
<div class="row">
    <div class="col-md-2 left-side">
        <ul class="list-group list-group-flush">
        <form action="" method="POST">
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="antc">Antikviteti</button>
            </li>
            </a> 
            <a href="#">       
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="audio">Audio</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
            <button class="simple" name="auto">Automobili</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
            <button class="simple" name="bteh">Bela tehnika</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="bicikli">Bicikli</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="domhrana">Domaća hrana</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
            <button class="simple" name="dvoriste">Dvorište i bašta</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
            <button class="simple" name="elek">Elektronika</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="igracke">Igračke i igre</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="knjige">Knjige</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="komp">Kompjuteri</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="konz">Konzole i igrice</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="ljubimci">Kućni ljubimci</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="mobilni">Mobilni telefoni</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="motocikli">Motocikli</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="muzika">Muzika i instrumenti</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="nakit">Nakit, satovi</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="namestaj">Nameštaj</button>  
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="nekretnine">Nekretnine</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="odeca">Odeća</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="sport">Sport</button>
            </li>
            </a>
            <a href="#">
            <li class="list-group-item list-group-item-action">
                <button class="simple" name="tv">TV i video</button>
            </li>
            </a>
        </form>
        </ul>
    </div>

    <?php 
        if(isset($_POST['antc'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'antikviteti' ";
        }else if(isset($_POST['audio'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'audio' ORDER BY id DESC ";
        }else if(isset($_POST['auto'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'automobili' ORDER BY id DESC ";
        }else if(isset($_POST['bteh'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'bela tehnika' ORDER BY id DESC ";
        }else if(isset($_POST['bicikli'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'Bicikli' ORDER BY id DESC ";
        }else if(isset($_POST['domhrana'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'domaca hrana' ORDER BY id DESC ";
        }else if(isset($_POST['dvoriste'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'dvoriste i basta' ORDER BY id DESC ";
        }else if(isset($_POST['elek'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'elektronika' ORDER BY id DESC ";
        }else if(isset($_POST['igracke'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'igracke i igre' ORDER BY id DESC ";
        }else if(isset($_POST['knjige'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'knjige' ORDER BY id DESC ";
        }else if(isset($_POST['komp'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'kompjuteri' ORDER BY id DESC ";
        }else if(isset($_POST['konz'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'konzole i igrice' ORDER BY id DESC ";
        }else if(isset($_POST['ljubimci'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'kucni ljubimci' ORDER BY id DESC ";
        }else if(isset($_POST['mobilni'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'mobilni telefoni' ORDER BY id DESC ";
        }else if(isset($_POST['motocikli'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'motocikli' ORDER BY id DESC ";
        }else if(isset($_POST['muzika'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'muzika i instrumenti' ORDER BY id DESC ";
        }else if(isset($_POST['nakit'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'nakit i satovi' ORDER BY id DESC ";
        }else if(isset($_POST['namestaj'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'namestaj' ORDER BY id DESC ";
        }else if(isset($_POST['nekretnine'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'nekretnine' ORDER BY id DESC ";
        }else if(isset($_POST['odeca'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'odeca' ORDER BY id DESC ";
        }else if(isset($_POST['sport'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'sport' ORDER BY id DESC ";
        }else if(isset($_POST['tv'])){
            $product_qry = "SELECT * FROM products WHERE type LIKE 'tv i video' ORDER BY id DESC ";
        }else{
            $product_qry = "SELECT * FROM products ORDER BY id DESC";
        }
        $product_res = mysqli_query($conn, $product_qry);
        $res = mysqli_num_rows($product_res);
    ?>

    <div class="col-md-8">
    <?php 
    
    if($res == 0){
        echo "Nema rezultata";
    }else{
        while($product_data = mysqli_fetch_assoc($product_res)){
            if(strlen($product_data['customer']) == 0){
                
                $product_name = $product_data['name'];

                $product_pic = "SELECT picture FROM products_gallery WHERE product = '$product_name' ";
                $prod_res = mysqli_query($conn, $product_pic);
                $prod_i = mysqli_fetch_array($prod_res);
                $prod_final = $prod_i['picture'];
        ?>
        <?php echo "<a href='product-page.php?name=".$product_data['name']."' style='text-decoration-color:white'>"; ?>
            <div class="container product">
                <img src="products-pics/<?php echo $prod_final; ?>" width="" height="100%" class="product-pic">
                <p class="left"><?php echo $product_data['name']; ?><span class="price">Cena: <?php echo $product_data['price']; ?></span></p>
                <p class="right"><?php echo $product_data['location']; ?><span class="type2"><?php echo $product_data['type']; ?></span></p>
            </div>
        <?php echo "</a>"; 
            }
        }
    }
    ?>
    </div>
</div>

<script type="text/javascript">
    
</script>
</body>
</html>