<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Input Result</title>
    <link rel = "stylesheet" href = "style.css">
    <script src = "input.js"></script>
</head>

<div class = "topbar">
    <img class = "topbar-logo" src = "assets/techive_logo.png" alt = "Logo Image">
    <a class = "button" href = "mainpage.html">HOME</a>          
    <a class = "button" id = "buy">BUY</a>
    <a class = "button" id = "sell">SELL</a>
    <a class = "button" href = "input_central.html" id = "input">INPUT</a>
    <a class = "button" href = "imprint.html" id = "imprint">IMPRINT</a>
</div>

<div>
    <?php
    include 'req.php'; // req.php contains $host, $user, $password, and $db for connection

    // Create a connection to the database using mysqli
    $connection = new mysqli($host, $user, $password, $db);

    // Check if the connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Capture the selected input type from the form selector
        $input_type = $_POST['input_type'] ?? '';

        // Ensure we have a valid input type
        if (!empty($input_type)) {
            
            // Initialize a variable for the SQL query
            $sql = '';

            // Handle different input types based on the selected form
            switch ($input_type) {
                case 'customer':
                    // Customer form data
                    $id = $connection->real_escape_string($_POST['id']);
                    $name = $connection->real_escape_string($_POST['name']);
                    $email = $connection->real_escape_string($_POST['email']);
                    $phone = $connection->real_escape_string($_POST['phone']);
                    $address = $connection->real_escape_string($_POST['address']);

                    // Insert into Customer table
                    $sql = "INSERT INTO Customer (id, name, email, phone, address) VALUES ('$id', '$name', '$email', '$phone', '$address')";
                    break;

                case 'buyer':
                    // Buyer form data
                    $buyer_id = $connection->real_escape_string($_POST['buyer_id']);
                    $username = $connection->real_escape_string($_POST['username']);
                    $password = $connection->real_escape_string($_POST['password']);
                    $customer_id = $connection->real_escape_string($_POST['customer_id']);

                    // Insert into Buyer table
                    $sql = "INSERT INTO Buyer (buyer_id, username, password, customer_id) VALUES ('$buyer_id', '$username', '$password', '$customer_id')";
                    break;

                case 'seller':
                    // Seller form data
                    $seller_id = $connection->real_escape_string($_POST['seller_id']);
                    $username = $connection->real_escape_string($_POST['username']);
                    $password = $connection->real_escape_string($_POST['password']);
                    $customer_id = $connection->real_escape_string($_POST['customer_id']);

                    // Insert into Seller table
                    $sql = "INSERT INTO Seller (seller_id, username, password, customer_id) VALUES ('$seller_id', '$username', '$password', '$customer_id')";
                    break;

                case 'electronics':
                    // Electronics form data
                    $product_id = $connection->real_escape_string($_POST['product_id']);
                    $product_name = $connection->real_escape_string($_POST['product_name']);
                    $brand = $connection->real_escape_string($_POST['brand']);
                    $price = $connection->real_escape_string($_POST['price']);

                    // Insert into Electronics table
                    $sql = "INSERT INTO Electronics (product_id, product_name, brand, price) VALUES ('$product_id', '$product_name', '$brand', '$price')";
                    break;

                case 'h_electronics':
                    // Household Electronics form data
                    $product_id = $connection->real_escape_string($_POST['product_id']);
                    $power_consumption = $connection->real_escape_string($_POST['power_consumption']);
                    $dimensions = $connection->real_escape_string($_POST['dimensions']);

                    // Insert into Household Electronics table
                    $sql = "INSERT INTO Household_Electronics (product_id, power_consumption, dimensions) VALUES ('$product_id', '$power_consumption', '$dimensions')";
                    break;

                case 'c_electronics':
                    // Consumer Electronics form data
                    $product_id = $connection->real_escape_string($_POST['product_id']);
                    $operating_systems = $connection->real_escape_string($_POST['operating_systems']);
                    $storage = $connection->real_escape_string($_POST['storage']);
                    $colour = $connection->real_escape_string($_POST['colour']);

                    // Insert into Consumer Electronics table
                    $sql = "INSERT INTO Consumer_Electronics (product_id, operating_systems, storage, colour) VALUES ('$product_id', '$operating_systems', '$storage', '$colour')";
                    break;

                case 'order':
                    // Order form data
                    $order_id = $connection->real_escape_string($_POST['order_id']);
                    $order_date = $connection->real_escape_string($_POST['order_date']);
                    $order_status = $connection->real_escape_string($_POST['order_status']);
                    $buyer_id = $connection->real_escape_string($_POST['buyer_id']);

                    // Insert into Order table
                    $sql = "INSERT INTO Orders (order_id, order_date, order_status, buyer_id) VALUES ('$order_id', '$order_date', '$order_status', '$buyer_id')";
                    break;

                case 'delivery':
                    // Delivery form data
                    $order_id = $connection->real_escape_string($_POST['order_id']);
                    $delivery_address = $connection->real_escape_string($_POST['delivery_address']);
                    $delivery_date = $connection->real_escape_string($_POST['delivery_date']);
                    $tracking_id = $connection->real_escape_string($_POST['tracking_id']);
                    $delivery_fee = $connection->real_escape_string($_POST['delivery_fee']);

                    // Insert into Delivery table
                    $sql = "INSERT INTO Delivery (order_id, delivery_address, delivery_date, tracking_id, delivery_fee) VALUES ('$order_id', '$delivery_address', '$delivery_date', '$tracking_id', '$delivery_fee')";
                    break;

                case 'pickup':
                    // Pickup form data
                    $order_id = $connection->real_escape_string($_POST['order_id']);
                    $pickup_date = $connection->real_escape_string($_POST['pickup_date']);
                    $pickup_time = $connection->real_escape_string($_POST['pickup_time']);
                    $location = $connection->real_escape_string($_POST['location']);

                    // Insert into Pickup table
                    $sql = "INSERT INTO Pickup (order_id, pickup_date, pickup_time, location) VALUES ('$order_id', '$pickup_date', '$pickup_time', '$location')";
                    break;

                case 'buys':
                    // Buys form data
                    $buyer_id = $connection->real_escape_string($_POST['buyer_id']);
                    $product_id = $connection->real_escape_string($_POST['product_id']);

                    // Insert into Buys table
                    $sql = "INSERT INTO Buys (buyer_id, product_id) VALUES ('$buyer_id', '$product_id')";
                    break;

                case 'sells':
                    // Sells form data
                    $seller_id = $connection->real_escape_string($_POST['seller_id']);
                    $product_id = $connection->real_escape_string($_POST['product_id']);
                
                    // Insert into Sells table
                    $sql = "INSERT INTO Sells (seller_id, product_id) VALUES ('$seller_id', '$product_id')";
                    break;

                default:
                    echo "Invalid input type.";
                    exit;
            }

            // Execute the SQL query
            if ($connection->query($sql) === TRUE) {
                echo "New record created successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }

        } else {
            echo "No input type selected.";
        }

    } else {
        echo "Invalid request method.";
    }

    // Close the connection
    $connection->close();

    ?>
</div>