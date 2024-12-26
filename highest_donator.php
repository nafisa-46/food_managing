<?php
include("login.php"); 
if($_SESSION['name']==''){
    header("location: signin.php");
}

$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'food_managing');


$query = "SELECT email, name, address, location, phoneno, SUM(quantity) AS total_quantity FROM food_donations GROUP BY email ORDER BY total_quantity DESC LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $highest_donator_email = $row['email'];
    $highest_donator_name = $row['name'];
    $highest_donator_address = $row['address'];
    $highest_donator_location = $row['location'];
    $highest_donator_phoneno = $row['phoneno'];
    $highest_donator_total_quantity = $row['total_quantity'];
} else {
    
    $highest_donator_email = "";
    $highest_donator_name = "";
    $highest_donator_address = "";
    $highest_donator_location = "";
    $highest_donator_phoneno = "";
    $highest_donator_total_quantity = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donate</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body style="background-color: #06C167;">
    <div class="container">
        <div class="regformf">
            <form action="" method="post">
                <p class="logo">Food <b style="color: #06C167;">Donate</b></p>
                
                <p>Highest Donator:</p>
                <p>Email: <?php echo $highest_donator_email; ?></p>
                <p>Name: <?php echo $highest_donator_name; ?></p>
                <p>Address: <?php echo $highest_donator_address; ?></p>
                <p>Location: <?php echo $highest_donator_location; ?></p>
                <p>Phone Number: <?php echo $highest_donator_phoneno; ?></p>
                <p>Total Quantity Donated: <?php echo $highest_donator_total_quantity; ?></p>

                
            </form>
        </div>
    </div>
</body>
</html>
