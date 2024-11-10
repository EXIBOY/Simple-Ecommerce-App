<?php

    if (count($_POST)) {
        $productName = $_POST['productName'];
        $productPrice = $_POST['price'];
        $productQuantity = $_POST['quantity'];
        $productSize = $_POST['size'];
        $productImage = $_POST['image'];

        // Connect to database
        $mysqli = new mysqli("127.0.0.1", "root", "password", "Shop");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        } else {
            $sql = "INSERT INTO products (name, price, quantity, size, pictures) VALUES ('$productName', $productPrice, $productQuantity, '$productSize', '')";

            if ($mysqli->query($sql) === TRUE) {
                header('Location: index.php');
            }
        }
    }
