<?php

include 'config.php';
session_start();


if(!isset($_SESSION['role'])){
    header("location:sign.php");
}

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'customer'){
        header("location:home-customer.php");
    }else if($_SESSION['role'] == 'admin'){
        header("location:home-admin1.php");
    }
}

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
    <link rel="stylesheet" href="home-customer.css">
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
        <a href="salesman-products.php">
            <img src="website-pics/logo.png" class="logo">
        </a>
    <div class="right-div">
    <h5>Ulogovani ste kao <?php echo $_SESSION['username']; ?></h5>
    <a class="nav-link dropdown-toggle right-a" href="#" id="navbardrop" data-toggle="dropdown">
        <img src="profile-pics/<?php echo $profilepic; ?>" width="45px" height="45px" class="mini-profile">
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="home-salesman1.php">Početna stranica</a>
        <a class="dropdown-item" href="salesman-profile1.php">Pogledaj Profil</a>
        <a class="dropdown-item" href="edit-profile-salesman.php">Izmeni Profil</a>
        <a class="dropdown-item" href="salesman-products.php">Moji proizvodi</a>
        <a class="dropdown-item" href="salesman-send.php">Čeka se za slanje</a>
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

<div class="search">
    <button class="search-button2" onclick='return openPopup()'>Klikni ovde da pretražiš proizvode</button>
</div><br>

<div id="popup" class="hide">
    <div class="popup">
        <div class="popup-content">
        <button id="close2" class="close" onclick='return closePopup()'>X</button>

            <div class="container searchbox">
                <form action="" method="GET">
                    <div class="form-group selectbox">
                        <select class="form-control dropdown" id="sel1" name="list">
                            <option disabled selected>Pretraži proizvode po kategoriji: </option>
                            <option>Antikviteti</option>
                            <option>Audio</option>
                            <option>Automobili</option>
                            <option>Bela tehnika</option>
                            <option>Bicikli</option>
                            <option>Domaća hrana</option>
                            <option>Dvorište i bašta</option>
                            <option>Elektronika</option>
                            <option>Igračke i igre</option>
                            <option>Knjige</option>
                            <option>Kompjuteri</option>
                            <option>Konzole i igrice</option>
                            <option>Kućni ljubimci</option>
                            <option>Mobilni telefoni</option>
                            <option>Motocikli</option>
                            <option>Muzika i instrumenti</option>
                            <option>Nakit i satovi</option>
                            <option>Nameštaj</option>
                            <option>Nekretnine</option>
                            <option>Odeća</option>
                            <option>Sport</option>
                            <option>TV i Video</option>
                        </select>
                    </div>
                    <button type="submit" class="search-button dropdown-button" name="category_search">Pretraži</button>
                </form>
            </div>


            <div class="row search-row">
                <div class="col-md-12">
                    <div class="container search center" style="width: 100%;">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input type="text" class="search-input form-control" placeholder="Pretraži proizvode" name="input_search">
                                <div class="input-group-appen">
                                    <button class="search-button" name="name_search">Pretraži</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="sort-row">
                <p>Sortiraj po ceni</p>
                <form action="" method="GET"> 
                    <input type="radio" name="order" value="greater" checked>
                    <label for="greater">Od više ka nižoj</label><br>

                    <input type="radio" name="order" value="smaller">
                    <label for="smaller">Od niže ka višoj</label><br>

                    <button type="submit" class="search-button" name="price-search">Pretraži</button>
                </form>
            </div>

        </div>
    </div>  
</div>


    <?php 

        $product_qry = "SELECT * FROM products WHERE salesman = '$username' AND customer = '' AND sold = '' ORDER BY id DESC";

        if(isset($_GET['name_search'])){
            $search = mysqli_real_escape_string($conn, $_GET['input_search']);
            $product_qry = "SELECT * FROM products WHERE name LIKE '%$search%' AND customer = '' AND sold = '' ORDER BY id DESC";
        }

        if(isset($_GET['price-search'])){
            if(isset($_GET['order'])){
                $order = $_GET['order'];
                if($order == 'smaller'){
                    $product_qry = "SELECT * FROM products WHERE salesman = '$username' AND customer = '' AND sold = '' ORDER BY `price`";
                }else if($order == 'greater'){
                    $product_qry = "SELECT * FROM products WHERE salesman = '$username' AND customer = '' AND sold = '' ORDER BY `price` DESC";
                }
            }
        }

        if(isset($_GET['category_search'])){
            $search = mysqli_real_escape_string($conn, $_GET['list']);
            $product_qry = "SELECT * FROM products WHERE type LIKE '%$search%' AND salesman = '$username' AND customer = '' AND sold = '' ORDER BY id DESC";
        }

        $product_res = mysqli_query($conn, $product_qry);
        $res = mysqli_num_rows($product_res);
    ?>

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
        <div class="container product">
            <?php echo "<a href='product-page-salesman.php?name=".$product_data['name']."' style='text-decoration-color:white'>"; ?>
                <img src="products-pics/<?php echo $prod_final; ?>" width="" height="100%" class="product-pic">
                <div class="left"><?php echo $product_data['name']; ?></div>
                <div class="price">Cena: <?php echo $product_data['price'].$product_data['currency']; ?></div>
                <p class="right"><?php echo $product_data['location']; ?><span class="type2"><?php echo $product_data['type']; ?></span></p>
                <div><p class="desc"><?php echo $product_data['description']; ?><p></div>
            <?php echo "</a>"; ?>
        </div>

        <div class="buttons">
            <?php echo "<a href='delete-product.php?name=".$product_data['name']."'>"; ?>
            <button class="search-button1" type="submit">Izbriši</button>
            <?php echo "</a>"; ?>
            <?php echo "<a href='update-product.php?name=".$product_data['name']."'>"; ?>
            <button class="search-button" type="submit">Izmeni</button><br><br>
            <?php echo "</a>"; ?>
        </div>

        <?php
            }
        }
    }

    ?>
    
</div>


<script type="text/javascript">

let popup = document.getElementById("popup");
let body = document.getElementsByTagName("BODY")[0];

function openPopup(){
    popup.classList.remove("hide");
    body.classList.add("no-scroll");
}

function closePopup(){
    popup.classList.add("hide");
    body.classList.remove("no-scroll");
}

</script>
</body>
</html>