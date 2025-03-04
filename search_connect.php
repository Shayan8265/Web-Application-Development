<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <link rel = "stylesheet" href = "style.css">
</head>

<div class = "topbar">
    <img class = "topbar-logo" src = "assets/techive_logo.png" alt = "Logo Image">
    <a class = "button" href = "mainpage.html">HOME</a>          
    <a class = "button" id = "buy">BUY</a>
    <a class = "button" href = "search_central.html" id = "search">SEARCH</a>
    <a class = "button" href = "input_central.html" id = "input">INPUT</a>
    <a class = "button" href = "imprint.html" id = "imprint">IMPRINT</a>
</div>

<?php
include('req.php');

// Check which query to run based on the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Establish database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query 4: Count Total Orders for Each Buyer
    if (isset($_POST['input_type']) && $_POST['input_type'] == 'total_orders') {
        $sql = "SELECT B.Username, COUNT(O.OrderID) AS TotalOrders
                FROM Buyer B
                LEFT JOIN `Order` O ON B.BuyerID = O.BuyerID
                GROUP BY B.Username";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Username</th><th>Total Orders</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Username"] . "</td><td>" . $row["TotalOrders"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    }

    // Query 5: Find Products Sold by Each Seller
    elseif (isset($_POST['input_type']) && $_POST['input_type'] == 'seller_products') {
        $sql = "SELECT S.Username, E.ProductName
                FROM Seller S
                JOIN Sells R ON S.SellerID = R.SellerID
                JOIN Electronics E ON R.ProductID = E.ProductID";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Seller Username</th><th>Product Name</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Username"] . "</td><td>" . $row["ProductName"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    }

    // Query 7: Find Completed Orders from OrderID
    elseif (isset($_POST['input_type']) && $_POST['input_type'] == 'completed_orders') {
        $sql = "SELECT O.OrderID, O.OrderDate, D.DeliveryFee
                FROM `Order` O
                JOIN Delivery D ON O.OrderID = D.OrderID
                WHERE O.OrderStatus = 'Completed'";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Order ID</th><th>Order Date</th><th>Delivery Fee</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["OrderID"] . "</td><td>" . $row["OrderDate"] . "</td><td>" . $row["DeliveryFee"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Order not completed or doesn't exist.";
        }
    }

    else {
        echo "Error: Invalid query type. Please select a valid option.";
    }

    // Close connection
    $conn->close();
}
?>