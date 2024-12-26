<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highest Donator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #06c167;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #c1064e;
            text-align: center;
            font-size: 30px;
        }
        .donator-info {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        p {
            margin: 10px 0;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Include your database connection code here
        include("connect.php"); 

        // Write SQL query to fetch highest donator with their name, email, address, location, phone number, and total donation quantity
        $query = "SELECT name, email, address, location, phoneno, SUM(quantity) AS total_donation FROM food_donations GROUP BY name, email, address, location, phoneno ORDER BY total_donation DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);

        // Display the highest donator information
        if ($row) {
            echo "<h1>Highest Donator</h1>";
            echo "<div class='donator-info'>";
            echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
            echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
            echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
            echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
            echo "<p><strong>Phone Number:</strong> " . $row['phoneno'] . "</p>";
            echo "<p><strong>Total Quantity Donated:</strong> " . $row['total_donation'] . "</p>";
            echo "</div>";
        } else {
            echo "<p>No donators found.</p>";
        }
        ?>
    </div>
</body>
</html>
