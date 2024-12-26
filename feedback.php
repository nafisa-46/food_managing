<?php
session_start(); // Start session to access session variables

// Establish connection to the database
$connection = mysqli_connect("localhost", "root", "", "food_managing");

// Check if connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if ($_SESSION['name'] == '') {
    header("location:signin.php");
    exit(); // Terminate script execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .gold-star {
            color: gold;
        }
    </style>
</head>
<body>
    <nav>
        <!-- Your navigation content here -->
    </nav>

    <section class="dashboard">
        <div class="top">
            <!-- Your top section content here -->
        </div>

        <div class="activity">
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch user feedback data
                            $query = "SELECT * FROM user_feedback";
                            $result = mysqli_query($connection, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td data-label=\"name\">" . $row['name'] . "</td>";
                                    echo "<td data-label=\"email\">" . $row['email'] . "</td>";
                                    echo "<td data-label=\"message\">" . $row['message'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan=\"3\">No feedback found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="delivery-boys">
            <h2>Delivery Boys</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Static delivery boy names and ratings
                    $deliveryBoys = array(
                        array("name" => "Abir", "rating" => 4.5),
                        array("name" => "Fahim", "rating" => 3.8),
                        array("name" => "Joy", "rating" => 5),
                        array("name" => "Siam", "rating" => 4.8),
                        array("name" => "Rony", "rating" => 4.2)
                    );

                    foreach ($deliveryBoys as $boy) {
                        echo "<tr>";
                        echo "<td data-label=\"name\">" . $boy['name'] . "</td>";
                        echo "<td data-label=\"rating\">";
                        // Display stars based on rating
                        $rating = $boy['rating'];
                        for ($i = 1; $i <= 5; $i++) {
                            if ($rating >= $i) {
                                echo "<i class=\"fa fa-star gold-star\"></i>";
                            } else {
                                echo "<i class=\"fa fa-star\"></i>";
                            }
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="admin.js"></script>
</body>
</html>
