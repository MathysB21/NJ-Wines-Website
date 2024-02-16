<?php
session_start();

$conn = new mysqli("localhost", "root", "", "nj_wines");

// echo $_SESSION['logged_in'];

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // The session variable has been initialized and its value is true
    // Retrieve the customer ID from the session
    $customerInfo = json_decode($_SESSION['user_info']);
    $customerID = $_SESSION['user_id'];

    // Query to check if there are any existing orders for the customer
    $selectQuery = "SELECT id FROM orders WHERE customer_id = '$customerID'";
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) == 0) {
        // No existing order found, create a new order

        $insertQuery = "INSERT INTO orders (customer_id, status, total_amount, payment_method)
                    VALUES ('$customerID', 'pending', 0, 'unknown')";

        if (mysqli_query($conn, $insertQuery)) {
            // Retrieve the newly inserted order ID
            $selectQuery = "SELECT id FROM orders WHERE customer_id = '$customerID'";
            $result = mysqli_query($conn, $selectQuery);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $orderID = $row['id'];

                // Insert order item
                $wineID = $_SESSION['id'];
                $quantity = 6;
                $price = $_SESSION['price'];

                $insertItemQuery = "INSERT INTO order_items (order_id, wine_id, quantity, price)
                                VALUES ('$orderID', '$wineID', '$quantity', '$price')";

                if (mysqli_query($conn, $insertItemQuery)) {
                    // Update the total amount in the orders table
                    $totalAmount = $quantity * $price;

                    $updateQuery = "UPDATE orders SET total_amount = '$totalAmount'
                                WHERE customer_id = '$customerID'";

                    if (mysqli_query($conn, $updateQuery)) {
                        // echo "Order placed successfully.";
                        // header('Location: cart.php');
                    } else {
                        echo "Failed to update total amount in orders table: " . mysqli_error($conn);
                    }
                } else {
                    echo "Failed to insert order item: " . mysqli_error($conn);
                }
            } else {
                echo "Failed to retrieve order ID: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to create a new order: " . mysqli_error($conn);
        }
    } else {
        // Existing order found, handle accordingly
        $selectQuery = "SELECT id FROM orders WHERE customer_id = '$customerID'";
        $result = mysqli_query($conn, $selectQuery);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $orderID = $row['id'];

            // Insert order item
            $wineID = $_SESSION['id'];
            $quantity = 6;
            $price = $_SESSION['price'];

            $insertItemQuery = "INSERT INTO order_items (order_id, wine_id, quantity, price)
                                VALUES ('$orderID', '$wineID', '$quantity', '$price')";

            if (mysqli_query($conn, $insertItemQuery)) {
                // Update the total amount in the orders table
                $selectQuery = "SELECT total_amount FROM orders WHERE customer_id = '$customerID'";
                $result = mysqli_query($conn, $selectQuery);
                $row = mysqli_fetch_assoc($result);
                $oldTotal = $row['total_amount'];
                $totalAmount = $quantity * $price + $oldTotal;

                $updateQuery = "UPDATE orders SET total_amount = '$totalAmount'
                                WHERE customer_id = '$customerID'";

                if (mysqli_query($conn, $updateQuery)) {
                    // echo "Order placed successfully.";
                    header('Location: cart.php');
                } else {
                    echo "Failed to update total amount in orders table: " . mysqli_error($conn);
                }
            } else {
                echo "Failed to insert order item: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to retrieve order ID: " . mysqli_error($conn);
        }
    }
} else {
    // The session variable is not initialized or its value is not true
    header('Location: loginRegister.php');
}

exit();
