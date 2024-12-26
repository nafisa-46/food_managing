<?php
ob_start(); 
include("connect.php"); 
include '../connection.php';
if($_SESSION['name']==''){
    header("location:deliverylogin.php");
}
$name=$_SESSION['name'];
$city=$_SESSION['city'];

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);

$did=$_SESSION['Did'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="delivery.css">
</head>
<body>
<header>
        <div class="logo"><b style="color: #c1064e;">Food Donation</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="openmap.php" >map</a></li>
                <li><a href="deliverymyord.php" >myorders</a></li>
                <li ><a href="../logout.php"  >Logout</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <script>
        hamburger=document.querySelector(".hamburger");
        hamburger.onclick =function(){
            navBar=document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>
    <style>
        .itm{
            background-color: white;
            display: grid;
        }
        .itm img{
            width: 400px;
            height: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        p{
            text-align: center; font-size: 30PX;color: black; margin-top: 50px;
        }
        a{
            /* text-decoration: underline; */
        }
        @media (max-width: 767px) {
            .itm{
                /* float: left; */
                
            }
            .itm img{
                width: 350px;
                height: 350px;
            }
        }
         </style>
         <h2><center>Welcome <?php echo"$name";?></center></h2>

        <div class="itm" >
            <img src="../img/delivery.gif" alt="" width="400" height="400"> 
        </div>

        <div class="get">
            <?php
            // Define the SQL query to fetch unassigned orders
            $sql = "SELECT fd.Fid AS Fid, fd.location as cure, fd.name, fd.phoneno, fd.date, fd.delivery_by, fd.address as From_address
            FROM food_donations fd
            LEFT JOIN admin ad ON fd.assigned_to = ad.Aid
            WHERE assigned_to IS NOT NULL AND delivery_by IS NULL AND fd.location='$city';
            ";

            // Execute the query
            $result=mysqli_query($connection, $sql);

            // Check for errors
            if (!$result) {
                die("Error executing query: " . mysqli_error($conn));
            }

            // Fetch the data as an associative array
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            // If the delivery person has taken an order, update the assigned_to field in the database
            if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
                $order_id = $_POST['order_id'];
                $delivery_person_id = $_POST['delivery_person_id'];
                $sql = "SELECT * FROM food_donations WHERE Fid = $order_id AND delivery_by IS NOT NULL";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Order has already been assigned to someone else
                    die("Sorry, this order has already been assigned to someone else.");
                }

                $sql = "UPDATE food_donations SET delivery_by = $did WHERE Fid = $order_id";
                $result=mysqli_query($connection, $sql);

                if (!$result) {
                    die("Error assigning order: " . mysqli_error($conn));
                }

                // Reload the page to prevent duplicate assignments
                header('Location: ' . $_SERVER['REQUEST_URI']);
                ob_end_flush();
            }
            ?>
            <div class="log">
                <a href="deliverymyord.php">My orders</a>
            </div>

            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone No</th>
                                <th>Date/Time</th>
                                <th>Pickup Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row) { ?>
                                <?php echo "<tr><td data-label=\"name\">" . $row['name'] . "</td><td data-label=\"phoneno\">" . $row['phoneno'] . "</td><td data-label=\"date\">" . $row['date'] . "</td><td data-label=\"Pickup Address\">" . $row['From_address'] . "</td>"; ?>
                                <td data-label="Action" style="margin:auto">
                                    <?php if ($row['delivery_by'] == null) { ?>
                                        <form method="post" action="">
                                            <input type="hidden" name="order_id" value="<?= $row['Fid'] ?>">
                                            <input type="hidden" name="delivery_person_id" value="<?= $id ?>">
                                            <button type="submit" name="food">Take order</button>
                                        </form>
                                    <?php } else if ($row['delivery_by'] == $id) { ?>
                                        Order assigned to you
                                    <?php } else { ?>
                                        Order assigned to another delivery person
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <br>
    <br>
</body>
</html>