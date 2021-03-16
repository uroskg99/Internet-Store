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
    <link rel="stylesheet" href="home-salesman.css">
</head>

<body>

<?php
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $sql = "SELECT * FROM products WHERE name='$name'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){    
      $productName = $row['name'];  
?>
        <div class = "movie-title"><?= $row['name'] ?></div>

</body>
</html>

<?php
}
?>